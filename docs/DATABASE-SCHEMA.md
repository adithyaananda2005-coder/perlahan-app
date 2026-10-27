# Skema Database PERLAHAN (usulan)

Status: draft untuk disepakati Adithya, Fadhil, dan PO. Dokumen ini belum berisi migration baru.

## users (sudah ada, branch backend/adithya)

| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint, PK | |
| name | string | |
| email | string, unique | |
| password | string | di-hash |
| role | string | admin, masyarakat, petugas_lapangan |
| timestamps | | |

## lahans (belum ada, bagian Adithya)

Usulan dari Modul 1 panduan terbaru.

| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint, PK | |
| kode_lahan | string, unique | |
| nama_lahan | string | |
| alamat | text | |
| kota | string, nullable | |
| luas | decimal(12,2) | meter persegi |
| latitude | decimal(10,7), nullable | |
| longitude | decimal(10,7), nullable | |
| status | enum | tersedia, diajukan, dimanfaatkan, tidak_aktif |
| deskripsi | text, nullable | |
| timestamps | | |

## pengajuans (sudah ada, branch database/schema)

| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint, PK | |
| user_id | FK ke users.id | pemilik pengajuan |
| lahan_id | bigint, index | FK ke lahans.id (migration add_lahan_foreign_key_to_pengajuans_table) |
| nama_kegiatan | string | |
| deskripsi_kegiatan | text | |
| tanggal_pengajuan | date | |
| status_pengajuan | string | default diajukan |
| alasan_penolakan | text, nullable | |
| dokumen_path | string, nullable | |
| timestamps | | |

Nilai status_pengajuan: diajukan, perlu_perbaikan, diverifikasi, ditolak, disetujui, selesai.

## riwayat_statuses (sudah ada, branch database/schema)

| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint, PK | |
| pengajuan_id | FK ke pengajuans.id | |
| user_id | FK ke users.id | yang mengubah status |
| status | string | |
| catatan | text, nullable | |
| tanggal_status | timestamp | |
| timestamps | | |

## Relasi

- users 1 ke N pengajuans
- lahans 1 ke N pengajuans (foreign key sudah ada)
- pengajuans 1 ke N riwayat_statuses
- users 1 ke N riwayat_statuses

## Keputusan terbuka

1. Dokumen pendukung: tetap satu kolom dokumen_path, atau tabel baru dokumen_pengajuan?
2. (Selesai) Foreign key lahan_id sudah ditambah lewat migration terpisah.
3. Tabel verifikasi, foto_verifikasi, dan monitoring: siapa yang menulis migration-nya dan kapan.
4. Daftar nilai status lahan: ikut usulan di atas atau diubah?