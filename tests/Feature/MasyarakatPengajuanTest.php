<?php

namespace Tests\Feature;

use App\Models\Lahan;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MasyarakatPengajuanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    private function buatLahan(array $attributes = []): Lahan
    {
        return Lahan::create(array_merge([
            'kode_lahan' => 'LH-' . fake()->unique()->numerify('#####'),
            'nama_lahan' => 'Lahan Uji',
            'alamat' => 'Alamat Lahan Uji',
            'kota' => 'Surabaya',
            'luas' => 1000,
            'status' => 'tersedia',
            'deskripsi' => 'Lahan untuk pengujian.',
        ], $attributes));
    }

    private function dataPengajuan(Lahan $lahan): array
    {
        return [
            'lahan_id' => $lahan->id,
            'nama_kegiatan' => 'Kegiatan Pertanian',
            'deskripsi_kegiatan' => 'Pengajuan kegiatan pertanian untuk pengujian.',
            'dokumen' => UploadedFile::fake()->create(
                'dokumen.pdf',
                100,
                'application/pdf'
            ),
        ];
    }

    public function test_masyarakat_dapat_mengirim_pengajuan_dan_riwayat_status_tercatat(): void
    {
        Storage::fake('local');

        $user = User::factory()->create(['role' => 'masyarakat']);
        $lahan = $this->buatLahan();

        $response = $this->actingAs($user)->post(
            route('masyarakat.pengajuan.store'),
            $this->dataPengajuan($lahan)
        );

        $response->assertRedirect(route('masyarakat.pengajuan.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pengajuans', [
            'user_id' => $user->id,
            'lahan_id' => $lahan->id,
            'nama_kegiatan' => 'Kegiatan Pertanian',
            'status_pengajuan' => 'diajukan',
        ]);

        $pengajuan = Pengajuan::where('user_id', $user->id)->firstOrFail();

        $this->assertNotNull($pengajuan->dokumen_path);
        Storage::disk('local')->assertExists($pengajuan->dokumen_path);

        $this->assertDatabaseHas('riwayat_statuses', [
            'pengajuan_id' => $pengajuan->id,
            'user_id' => $user->id,
            'status' => 'diajukan',
        ]);
    }

    public function test_pengajuan_ditolak_jika_lahan_tidak_tersedia(): void
    {
        Storage::fake('local');

        $user = User::factory()->create(['role' => 'masyarakat']);
        $lahan = $this->buatLahan(['status' => 'tidak_aktif']);

        $response = $this->actingAs($user)->from(
            route('masyarakat.pengajuan.create')
        )->post(
            route('masyarakat.pengajuan.store'),
            $this->dataPengajuan($lahan)
        );

        $response->assertRedirect(route('masyarakat.pengajuan.create'));
        $response->assertSessionHasErrors('lahan_id');

        $this->assertDatabaseCount('pengajuans', 0);
        $this->assertDatabaseCount('riwayat_statuses', 0);

        $this->assertSame(
            [],
            Storage::disk('local')->allFiles('dokumen-pengajuan')
        );
    }

    public function test_pengajuan_ditolak_jika_dokumen_bukan_pdf_jpg_jpeg_atau_png(): void
    {
        Storage::fake('local');

        $user = User::factory()->create(['role' => 'masyarakat']);
        $lahan = $this->buatLahan();

        $data = $this->dataPengajuan($lahan);
        $data['dokumen'] = UploadedFile::fake()->create(
            'dokumen.txt',
            10,
            'text/plain'
        );

        $response = $this->actingAs($user)->from(
            route('masyarakat.pengajuan.create')
        )->post(
            route('masyarakat.pengajuan.store'),
            $data
        );

        $response->assertRedirect(route('masyarakat.pengajuan.create'));
        $response->assertSessionHasErrors('dokumen');

        $this->assertDatabaseCount('pengajuans', 0);
        $this->assertDatabaseCount('riwayat_statuses', 0);

        $this->assertSame(
            [],
            Storage::disk('local')->allFiles('dokumen-pengajuan')
        );
    }

    public function test_masyarakat_hanya_melihat_pengajuan_miliknya_sendiri(): void
    {
        $pemilik = User::factory()->create(['role' => 'masyarakat']);
        $penggunaLain = User::factory()->create(['role' => 'masyarakat']);

        $lahanPertama = $this->buatLahan();
        $lahanKedua = $this->buatLahan();

        Pengajuan::create([
            'user_id' => $pemilik->id,
            'lahan_id' => $lahanPertama->id,
            'nama_kegiatan' => 'Pengajuan Milik Saya',
            'deskripsi_kegiatan' => 'Deskripsi pengajuan pertama.',
            'tanggal_pengajuan' => now()->toDateString(),
            'status_pengajuan' => 'diajukan',
        ]);

        Pengajuan::create([
            'user_id' => $penggunaLain->id,
            'lahan_id' => $lahanKedua->id,
            'nama_kegiatan' => 'Pengajuan Orang Lain',
            'deskripsi_kegiatan' => 'Deskripsi pengajuan kedua.',
            'tanggal_pengajuan' => now()->toDateString(),
            'status_pengajuan' => 'diajukan',
        ]);

        $response = $this->actingAs($pemilik)->get(
            route('masyarakat.pengajuan.index')
        );

        $response->assertOk();
        $response->assertSee('Pengajuan Milik Saya');
        $response->assertDontSee('Pengajuan Orang Lain');

        $this->assertSame(1, $pemilik->pengajuan()->count());
        $this->assertSame(1, $penggunaLain->pengajuan()->count());
    }

    public function test_tamu_tidak_dapat_mengirim_pengajuan(): void
    {
        $response = $this->post(
            route('masyarakat.pengajuan.store'),
            []
        );

        $response->assertRedirect('/login');
        $this->assertDatabaseCount('pengajuans', 0);
    }
}
