<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LahanSeeder extends Seeder
{
    /**
     * Data simulasi lahan di Surabaya (bukan data lahan sungguhan).
     */
    public function run(): void
    {
        $data = [
            [
                'kode_lahan' => 'LHN-001',
                'nama_lahan' => 'Lahan Kosong Wonokromo',
                'alamat' => 'Kawasan Wonokromo, Surabaya (data simulasi)',
                'kota' => 'Surabaya',
                'luas' => 850.00,
                'latitude' => -7.2997000,
                'longitude' => 112.7378000,
                'status' => 'tersedia',
                'deskripsi' => 'Lahan datar yang belum dimanfaatkan, akses jalan baik.',
            ],
            [
                'kode_lahan' => 'LHN-002',
                'nama_lahan' => 'Lahan Pinggir Rungkut',
                'alamat' => 'Kawasan Rungkut, Surabaya (data simulasi)',
                'kota' => 'Surabaya',
                'luas' => 1500.50,
                'latitude' => -7.3354000,
                'longitude' => 112.7878000,
                'status' => 'tersedia',
                'deskripsi' => 'Lahan cukup luas, cocok untuk kebun komunitas.',
            ],
            [
                'kode_lahan' => 'LHN-003',
                'nama_lahan' => 'Lahan Sudut Gubeng',
                'alamat' => 'Kawasan Gubeng, Surabaya (data simulasi)',
                'kota' => 'Surabaya',
                'luas' => 320.00,
                'latitude' => -7.2756000,
                'longitude' => 112.7523000,
                'status' => 'diajukan',
                'deskripsi' => 'Lahan kecil di tengah kota, sedang ada pengajuan.',
            ],
            [
                'kode_lahan' => 'LHN-004',
                'nama_lahan' => 'Lahan Belakang Sukolilo',
                'alamat' => 'Kawasan Sukolilo, Surabaya (data simulasi)',
                'kota' => 'Surabaya',
                'luas' => 2100.75,
                'latitude' => -7.2928000,
                'longitude' => 112.8010000,
                'status' => 'dimanfaatkan',
                'deskripsi' => 'Sudah dimanfaatkan sebagai taman warga.',
            ],
            [
                'kode_lahan' => 'LHN-005',
                'nama_lahan' => 'Lahan Terbuka Tandes',
                'alamat' => 'Kawasan Tandes, Surabaya (data simulasi)',
                'kota' => 'Surabaya',
                'luas' => 1200.00,
                'latitude' => -7.2616000,
                'longitude' => 112.6806000,
                'status' => 'tersedia',
                'deskripsi' => 'Lahan terbuka dengan sumber air di sekitar.',
            ],
            [
                'kode_lahan' => 'LHN-006',
                'nama_lahan' => 'Lahan Tepi Benowo',
                'alamat' => 'Kawasan Benowo, Surabaya (data simulasi)',
                'kota' => 'Surabaya',
                'luas' => 640.25,
                'latitude' => -7.2315000,
                'longitude' => 112.6144000,
                'status' => 'tidak_aktif',
                'deskripsi' => 'Tidak dapat dimanfaatkan untuk sementara.',
            ],
        ];

        foreach ($data as $row) {
            DB::table('lahans')->updateOrInsert(
                ['kode_lahan' => $row['kode_lahan']],
                $row + ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}