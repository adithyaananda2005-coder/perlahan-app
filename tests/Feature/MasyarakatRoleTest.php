<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class MasyarakatRoleTest extends TestCase
{
    use RefreshDatabase;
protected function setUp(): void
{
    parent::setUp();

    $this->withoutMiddleware(
        \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class
    );
}

    public function test_masyarakat_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat')
            ->assertOk();
    }

    public function test_admin_cannot_access_masyarakat_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat')
            ->assertForbidden();
    }

    public function test_petugas_cannot_access_masyarakat_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'petugas_lapangan',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat')
            ->assertForbidden();
    }

    public function test_masyarakat_can_access_profile(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat/profil')
            ->assertOk();
    }

    public function test_masyarakat_can_access_pengajuan_form(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->actingAs($user)
            ->get('/masyarakat/pengajuan/buat')
            ->assertOk();
    }

    public function test_guest_cannot_access_masyarakat_profile(): void
    {
        $this->get('/masyarakat/profil')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_pengajuan_form(): void
    {
        $this->get('/masyarakat/pengajuan/buat')
            ->assertRedirect('/login');
    }
public function test_masyarakat_can_update_profile(): void
{
    $user = User::factory()->create([
        'role' => 'masyarakat',
    ]);

    $this->actingAs($user)
        ->put('/masyarakat/profil', [
            'name' => 'Nama Baru',
            'email' => 'nama.baru@example.com',
            'password' => '',
            'password_confirmation' => '',
        ])
        ->assertRedirect(route('masyarakat.profil.show'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Nama Baru',
        'email' => 'nama.baru@example.com',
    ]);
}

public function test_masyarakat_profile_password_is_hashed_when_updated(): void
{
    $user = User::factory()->create([
        'role' => 'masyarakat',
    ]);

    $this->actingAs($user)
        ->put('/masyarakat/profil', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'PasswordBaru123',
            'password_confirmation' => 'PasswordBaru123',
        ])
        ->assertRedirect(route('masyarakat.profil.show'));

    $user->refresh();

    $this->assertTrue(
        Hash::check('PasswordBaru123', $user->password)
    );
}
}
