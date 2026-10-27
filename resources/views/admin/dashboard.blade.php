```php
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-heading', 'Dashboard')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Selamat Datang, Admin!
        </h1>

        <p class="mt-2 text-gray-600">
            Selamat datang di Sistem Pengelolaan Lahan PERLAHAN.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Data Lahan</p>
            <h2 class="mt-3 text-3xl font-bold text-green-700">0</h2>
            <p class="mt-2 text-sm text-gray-500">Lahan terdaftar</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Pengajuan Masuk</p>
            <h2 class="mt-3 text-3xl font-bold text-blue-700">0</h2>
            <p class="mt-2 text-sm text-gray-500">Menunggu pemeriksaan</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Petugas Lapangan</p>
            <h2 class="mt-3 text-3xl font-bold text-orange-600">0</h2>
            <p class="mt-2 text-sm text-gray-500">Petugas terdaftar</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Perlu Verifikasi</p>
            <h2 class="mt-3 text-3xl font-bold text-red-600">0</h2>
            <p class="mt-2 text-sm text-gray-500">Menunggu verifikasi</p>
        </div>

    </div>

    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Aktivitas Sistem</h2>

        <p class="mt-3 text-gray-500">
            Belum ada aktivitas untuk ditampilkan.
        </p>
    </div>

@endsection
```
