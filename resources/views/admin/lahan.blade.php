
@extends('layouts.admin')

@section('title', 'Data Lahan - Admin PERLAHAN')
@section('page-heading', 'Data Lahan')

@section('content')
@php
    $lahans = [
        [
            'kode' => 'LH-001',
            'nama' => 'Lahan Kosong Rungkut',
            'alamat' => 'Jl. Rungkut Madya, Rungkut',
            'lokasi' => 'Rungkut',
            'luas' => 1250,
            'kondisi' => 'Tanah datar',
            'status' => 'Tersedia',
            'gambar' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'kode' => 'LH-002',
            'nama' => 'Lahan Kelurahan Gubeng',
            'alamat' => 'Jl. Gubeng Kertajaya, Gubeng',
            'lokasi' => 'Gubeng',
            'luas' => 860,
            'kondisi' => 'Perlu pembersihan ringan',
            'status' => 'Diverifikasi',
            'gambar' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=900&q=80',
        ],
        [
            'kode' => 'LH-003',
            'nama' => 'Lahan Pinggir Sungai Wonokromo',
            'alamat' => 'Jl. Jagir Wonokromo, Wonokromo',
            'lokasi' => 'Wonokromo',
            'luas' => 2100,
            'kondisi' => 'Lahan memanjang',
            'status' => 'Dalam pemanfaatan',
            'gambar' => 'https://images.unsplash.com/photo-1499529112087-3cb3b73cec95?auto=format&fit=crop&w=900&q=80',
        ],
    ];

    $totalLahan = count($lahans);
    $totalLuas = array_sum(array_column($lahans, 'luas'));
@endphp

<div class="space-y-6">

    <!-- Judul halaman -->
    <section class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
        <div>
            <p class="mb-3 text-sm font-bold tracking-wider text-green-700">
                INVENTARIS RUANG KOTA
            </p>

            <h1 class="text-3xl font-medium tracking-tight text-[#263b2b]">
                Data Lahan
            </h1>

            <p class="mt-3 text-sm text-slate-500 sm:text-base">
                Jelajahi lahan pemerintah yang berpotensi dimanfaatkan bersama.
            </p>
        </div>

        <button type="button"
            onclick="alert('Form Tambah Lahan akan dibuat pada tahap berikutnya.')"
            class="inline-flex shrink-0 items-center justify-center gap-3 rounded-2xl bg-[#32643b] px-6 py-4 font-semibold text-white shadow-lg shadow-green-900/10 transition hover:bg-green-900">
            <i data-lucide="plus" class="h-5 w-5"></i>
            Tambah Lahan
        </button>
    </section>

    <!-- Panel pencarian dan filter -->
    <section class="grid grid-cols-1 gap-3 rounded-2xl border border-[#e1e9e2] bg-white p-4 md:grid-cols-2 xl:grid-cols-[2fr_1.1fr_0.9fr_0.9fr]">

        <div class="flex min-w-0 items-center gap-3 rounded-xl border border-[#dfe7e0] px-4 py-3">
            <i data-lucide="search" class="h-5 w-5 shrink-0 text-slate-400"></i>
            <input id="searchLahan"
                type="search"
                placeholder="Cari nama atau alamat lahan..."
                class="w-full min-w-0 bg-transparent text-sm outline-none placeholder:text-slate-300">
        </div>

        <div class="flex items-center gap-3 rounded-xl border border-[#c8ddca] px-4 py-3">
            <i data-lucide="map-pin" class="h-5 w-5 shrink-0 text-green-800"></i>
            <select id="filterLokasi"
                class="w-full min-w-0 bg-transparent text-sm font-semibold text-[#32643b] outline-none">
                <option value="">Semua Lokasi</option>
                <option value="Rungkut">Rungkut</option>
                <option value="Gubeng">Gubeng</option>
                <option value="Wonokromo">Wonokromo</option>
            </select>
        </div>

        <div class="flex items-center gap-3 rounded-xl border border-[#c8ddca] px-4 py-3">
            <i data-lucide="filter" class="h-5 w-5 shrink-0 text-green-800"></i>
            <select id="filterStatus"
                class="w-full min-w-0 bg-transparent text-sm font-semibold text-[#32643b] outline-none">
                <option value="">Semua Status</option>
                <option value="Tersedia">Tersedia</option>
                <option value="Diverifikasi">Diverifikasi</option>
                <option value="Dalam pemanfaatan">Dalam pemanfaatan</option>
            </select>
        </div>

        <div class="flex items-center gap-3 rounded-xl border border-[#c8ddca] px-4 py-3">
            <i data-lucide="ruler" class="h-5 w-5 shrink-0 text-green-800"></i>
            <select id="filterLuas"
                class="w-full min-w-0 bg-transparent text-sm font-semibold text-[#32643b] outline-none">
                <option value="">Semua Luas</option>
                <option value="kecil">Di bawah 1.000 m²</option>
                <option value="besar">1.000 m² ke atas</option>
            </select>
        </div>
    </section>

    <!-- Jumlah hasil dan pengurutan -->
    <section class="flex flex-wrap items-center justify-between gap-3 px-1">
        <p id="jumlahHasil" class="text-sm text-slate-500">
            Menampilkan {{ $totalLahan }} lahan potensial
        </p>

        <div class="flex items-center gap-2 text-sm text-slate-500">
            <label for="urutkan">Urutkan:</label>
            <select id="urutkan"
                class="cursor-pointer bg-transparent font-medium text-slate-600 outline-none">
                <option value="terbaru">Terbaru</option>
                <option value="nama">Nama A–Z</option>
                <option value="luas">Luas terbesar</option>
            </select>
        </div>
    </section>

    <!-- Kartu lahan -->
    <section id="daftarLahan" class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

        @foreach ($lahans as $lahan)
            @php
                $warnaStatus = match ($lahan['status']) {
                    'Tersedia' => 'bg-green-50 text-green-800',
                    'Diverifikasi' => 'bg-indigo-100 text-indigo-700',
                    default => 'bg-amber-100 text-amber-800',
                };
            @endphp

            <article
                class="kartu-lahan flex min-w-0 flex-col overflow-hidden rounded-2xl border border-[#e1e8e2] bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg"
                data-nama="{{ strtolower($lahan['nama']) }}"
                data-alamat="{{ strtolower($lahan['alamat']) }}"
                data-lokasi="{{ $lahan['lokasi'] }}"
                data-status="{{ $lahan['status'] }}"
                data-luas="{{ $lahan['luas'] }}"
                data-kode="{{ $lahan['kode'] }}">

                <!-- Foto -->
                <div class="relative h-56 overflow-hidden bg-slate-100">
                    <img
                        src="{{ $lahan['gambar'] }}"
                        alt="Foto {{ $lahan['nama'] }}"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 hover:scale-105"
                        onerror="this.style.display='none'">

                    <span class="absolute left-4 top-4 rounded-full px-4 py-2 text-xs font-bold {{ $warnaStatus }}">
                        {{ $lahan['status'] }}
                    </span>
                </div>

                <!-- Informasi -->
                <div class="flex flex-1 flex-col p-5">
                    <h2 class="text-lg font-medium leading-snug text-slate-800">
                        {{ $lahan['nama'] }}
                    </h2>

                    <p class="mt-3 flex items-start gap-2 text-xs leading-5 text-slate-500">
                        <i data-lucide="map-pin" class="mt-0.5 h-4 w-4 shrink-0"></i>
                        {{ $lahan['alamat'] }}
                    </p>

                    <div class="my-5 grid grid-cols-2 divide-x divide-slate-200 border-y border-slate-200 py-4">
                        <div class="pr-3">
                            <p class="font-bold text-slate-800">
                                {{ number_format($lahan['luas'], 0, ',', '.') }} m²
                            </p>
                            <p class="mt-1 text-xs text-slate-400">Luas lahan</p>
                        </div>

                        <div class="pl-4">
                            <p class="text-sm font-semibold leading-snug text-slate-800">
                                {{ $lahan['kondisi'] }}
                            </p>
                            <p class="mt-1 text-xs text-slate-400">Kondisi</p>
                        </div>
                    </div>

                   
                    <button
                        type="button"
                        onclick="alert(this.dataset.kode + ' akan dibuat pada tahap berikutnya.')"
                        data-kode="{{ $lahan['kode'] }}"
                        class="mt-auto flex w-full items-center justify-center gap-3 rounded-xl border border-[#bed8c1] px-4 py-3 font-semibold text-[#32643b] transition hover:bg-green-50">
                        Lihat Detail
                        <i data-lucide="chevron-right" class="h-5 w-5"></i>
                    </button>
                </div>
            </article>
                </div>
            </article>
        @endforeach

    </section>

    <!-- Kondisi tidak ditemukan -->
    <div id="hasilKosong" class="hidden rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-14 text-center">
        <i data-lucide="map-pin" class="mx-auto mb-3 h-10 w-10 text-slate-300"></i>
        <h3 class="font-semibold text-slate-700">Lahan tidak ditemukan</h3>
        <p class="mt-2 text-sm text-slate-500">
            Coba ubah kata pencarian atau filter yang digunakan.
        </p>
    </div>

    <p class="text-xs text-slate-400">
        Data pada halaman ini masih berupa contoh frontend dan belum terhubung ke database.
    </p>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('searchLahan');
    const lokasi = document.getElementById('filterLokasi');
    const status = document.getElementById('filterStatus');
    const luas = document.getElementById('filterLuas');
    const urutkan = document.getElementById('urutkan');
    const daftar = document.getElementById('daftarLahan');
    const jumlah = document.getElementById('jumlahHasil');
    const kosong = document.getElementById('hasilKosong');

    function perbaruiLahan() {
        const kata = search.value.trim().toLowerCase();
        const kartu = Array.from(daftar.querySelectorAll('.kartu-lahan'));
        let tampil = 0;

        kartu.forEach(function (item) {
            const cocokKata =
                item.dataset.nama.includes(kata) ||
                item.dataset.alamat.includes(kata) ||
                item.dataset.kode.toLowerCase().includes(kata);

            const cocokLokasi =
                !lokasi.value || item.dataset.lokasi === lokasi.value;

            const cocokStatus =
                !status.value || item.dataset.status === status.value;

            const nilaiLuas = Number(item.dataset.luas);
            const cocokLuas =
                !luas.value ||
                (luas.value === 'kecil' && nilaiLuas < 1000) ||
                (luas.value === 'besar' && nilaiLuas >= 1000);

            const cocok = cocokKata && cocokLokasi && cocokStatus && cocokLuas;

            item.classList.toggle('hidden', !cocok);

            if (cocok) tampil++;
        });

        kartu.sort(function (a, b) {
            if (urutkan.value === 'nama') {
                return a.dataset.nama.localeCompare(b.dataset.nama);
            }

            if (urutkan.value === 'luas') {
                return Number(b.dataset.luas) - Number(a.dataset.luas);
            }

            return a.dataset.kode.localeCompare(b.dataset.kode);
        });

        kartu.forEach(function (item) {
            daftar.appendChild(item);
        });

        jumlah.textContent =
            'Menampilkan ' + tampil + ' dari ' + kartu.length + ' lahan potensial';

        kosong.classList.toggle('hidden', tampil !== 0);
    }

    [search, lokasi, status, luas, urutkan].forEach(function (kontrol) {
        kontrol.addEventListener('input', perbaruiLahan);
        kontrol.addEventListener('change', perbaruiLahan);
    });
});
</script>
@endsection
