<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Pengajuan;
use App\Models\RiwayatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('pengajuans')) {
            return view('masyarakat.pengajuan.index', [
                'pengajuan' => collect(),
                'tableBelumTersedia' => true,
            ]);
        }

        $pengajuan = $request->user()
            ->pengajuan()
            ->with('lahan')
            ->latest()
            ->paginate(10);

        return view('masyarakat.pengajuan.index', [
            'pengajuan' => $pengajuan,
            'tableBelumTersedia' => false,
        ]);
    }

    public function create()
    {
        if (!Schema::hasTable('lahans')) {
            return redirect()
                ->route('masyarakat.lahan.index')
                ->with('info', 'Data lahan belum tersedia.');
        }

        $lahan = Lahan::query()
            ->where('status', 'tersedia')
            ->orderBy('nama_lahan')
            ->get();

        return view('masyarakat.pengajuan.create', compact('lahan'));
    }

    public function store(Request $request)
    {
        if (
            !Schema::hasTable('lahans')
            || !Schema::hasTable('pengajuans')
            || !Schema::hasTable('riwayat_statuses')
        ) {
            return back()
                ->withInput()
                ->with('info', 'Database pengajuan belum siap digunakan.');
        }

        $validated = $request->validate([
            'lahan_id' => [
                'required',
                'integer',
                Rule::exists('lahans', 'id')
                    ->where('status', 'tersedia'),
            ],
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'deskripsi_kegiatan' => ['required', 'string', 'max:5000'],
            'dokumen' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ]);

        $path = $request->file('dokumen')->store(
            'dokumen-pengajuan',
            'local'
        );

        try {
            DB::transaction(function () use ($request, $validated, $path) {
                $pengajuan = Pengajuan::create([
                    'user_id' => $request->user()->id,
                    'lahan_id' => $validated['lahan_id'],
                    'nama_kegiatan' => $validated['nama_kegiatan'],
                    'deskripsi_kegiatan' => $validated['deskripsi_kegiatan'],
                    'tanggal_pengajuan' => now()->toDateString(),
                    'status_pengajuan' => 'diajukan',
                    'dokumen_path' => $path,
                ]);

                RiwayatStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'user_id' => $request->user()->id,
                    'status' => 'diajukan',
                    'catatan' => 'Pengajuan dibuat oleh masyarakat.',
                    'tanggal_status' => now(),
                ]);
            });
        } catch (\Throwable $exception) {
            Storage::disk('local')->delete($path);

            report($exception);

            return back()
                ->withInput()
                ->with('info', 'Pengajuan gagal disimpan. Silakan coba kembali.');
        }

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }
}
