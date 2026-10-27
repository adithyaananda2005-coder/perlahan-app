<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LahanController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('lahans')) {
            return view('masyarakat.lahan.index', [
                'lahan' => collect(),
                'tableBelumTersedia' => true,
            ]);
        }

        $query = Lahan::query()
            ->where('status', 'tersedia');

        if ($request->filled('cari')) {
            $cari = $request->input('cari');

            $query->where(function ($q) use ($cari) {
                $q->where('nama_lahan', 'like', "%{$cari}%")
                    ->orWhere('alamat', 'like', "%{$cari}%");
            });
        }

        $lahan = $query->latest()->paginate(10)->withQueryString();

        return view('masyarakat.lahan.index', [
            'lahan' => $lahan,
            'tableBelumTersedia' => false,
        ]);
    }

    public function show($id)
    {
        abort_unless(Schema::hasTable('lahans'), 404);

        $lahan = Lahan::query()
            ->where('status', 'tersedia')
            ->findOrFail($id);

        return view('masyarakat.lahan.show', compact('lahan'));
    }
}
