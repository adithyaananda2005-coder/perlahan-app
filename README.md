# PERLAHAN — Laravel foundation

Repository awal untuk proyek PPL PERLAHAN. Dibuat sebagai baseline bersama; **jangan mengembangkan fitur langsung di `main`**. Anggota membuat branch dari commit baseline yang sama. Integrasi dilakukan setelah masing-masing pekerjaan direview.

## Stack proposal
- Laravel 11 + PHP 8.2+
- Laravel Blade, HTML, CSS, JavaScript, Tailwind CSS
- MySQL
- Leaflet.js + OpenStreetMap
- Laravel Storage untuk foto dan dokumen

## Setup lokal
1. Install PHP 8.2+, Composer, MySQL, Git.
2. `composer install`
3. `cp .env.example .env` (Windows PowerShell: `Copy-Item .env.example .env`)
4. Buat database MySQL bernama `perlahan`, lalu sesuaikan `.env`.
5. `php artisan key:generate`
6. `php artisan migrate`
7. `php artisan serve`
8. Buka `http://127.0.0.1:8000`.

Catatan: scaffold ini belum memuat fitur bisnis proposal. Auth, roles, tabel domain, UI dari prototype, dan peta akan ditambahkan pada branch tugas, lalu direview sebelum digabung.

## Branch workflow (wajib)
- `main`: baseline Laravel yang disepakati. Jangan push fitur langsung ke sini.
- `frontend/jingga`: UI informasi lahan, pencarian/filter, status/riwayat, responsivitas.
- `frontend/citra`: UI peta, pengajuan, verifikasi, monitoring, halaman petugas.
- `backend/adithya`: autentikasi, role/akses, user, CRUD lahan, pencarian/filter, integrasi MySQL.
- `backend/fadhil`: pengajuan, verifikasi, dokumen/foto, monitoring, riwayat, business logic.
- `database/schema`: rancangan migration/relasi bersama. Koordinasikan perubahan dengan Adithya dan Fadhil; jangan mengubah tabel yang dipakai fitur lain tanpa diskusi.

Branch di atas harus dibuat dari commit `main` baseline yang sama. Tidak ada merge antarbranch selama tahap salin/setup; integrasi baru dilakukan di akhir via Pull Request, review, dan tes.

## Membuat branch setelah `main` di-push
Jalankan `bash scripts/create-team-branches.sh` di Git Bash/macOS/Linux. Script berhenti bila working tree kotor atau branch sudah ada.

## Aturan kolaborasi
1. `main` protected jika fitur GitHub tersedia: PR wajib, minimal satu review, larang force-push.
2. Setiap anggota hanya mengerjakan scope branch yang ditugaskan; commit kecil dengan pesan jelas.
3. Jangan commit `.env`, password, token, file `vendor/`, atau `node_modules/`.
4. Setiap PR mencantumkan fitur, migration yang ditambahkan, langkah uji, dan screenshot jika UI.
5. Merge terakhir dilakukan bertahap: database contract → backend → frontend → regression test; resolve conflict bersama.
6. Semua fitur mengikuti proposal; rekomendasi pemanfaatan hanya informasi awal, bukan keputusan akhir.

## Acuan
- Proposal PDF yang diberikan: bagian 3.1 kebutuhan fungsional, 3.3 kebutuhan teknis, 4.2 arsitektur, 4.3 ERD, 5.2 jadwal, dan 5.3 pembagian tim.
- Prototype Figma: https://www.figma.com/make/3UWuqKuECenHCF6upMwz0O/Prototype-UI-Website-PERLAHAN?t=7navgfuDZwFb8qHq-1
- File prototype yang diberikan disimpan di `prototype-reference/` sebagai referensi desain, bukan dipasang sebagai aplikasi frontend terpisah.
