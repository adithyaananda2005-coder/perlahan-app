<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('pengajuan')) {
            return view('masyarakat.pengajuan.index', [
                'pengajuan' => collect(),
                'tableBelumTersedia' => true,
            ]);
        }

        $pengajuan = $request->user()
            ->pengajuan()
            ->latest()
            ->paginate(10);

        return view('masyarakat.pengajuan.index', [
            'pengajuan' => $pengajuan,
            'tableBelumTersedia' => false,
        ]);
    }

    public function create()
    {
        return view('masyarakat.pengajuan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'keterangan' => ['required', 'string', 'max:5000'],
            'dokumen' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ]);

        if (!Schema::hasTable('pengajuan')) {
            return back()
                ->withInput()
                ->with(
                    'info',
                    'Dokumen belum disimpan karena tabel pengajuan belum tersedia.'
                );
        }

        return back()
            ->withInput()
            ->with(
                'info',
                'Tabel pengajuan tersedia, tetapi penyimpanan belum diaktifkan karena struktur kolom database perlu dikonfirmasi.'
            );
    }
}
