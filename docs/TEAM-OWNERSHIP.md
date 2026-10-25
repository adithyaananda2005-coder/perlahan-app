# PERLAHAN — ownership & handoff

| Workstream | Owner | Isi |
|---|---|---|
| Product Owner | M. Brilliant Agung Wicaksono | Prioritas backlog, acceptance, review sprint |
| `frontend/jingga` | Jingga Amelia Putri | Informasi lahan, filter, status/riwayat pengajuan, responsive UI |
| `frontend/citra` | Citra Fadillah Agung | UI peta, pengajuan, verifikasi, monitoring, petugas |
| `backend/adithya` | Adithya Ananda Erdoansyah | Auth, role, user, CRUD lahan, filter, integrasi MySQL |
| `backend/fadhil` | M. Fadhil Al Munawwar | Pengajuan, verifikasi, uploads, monitoring, riwayat, business logic |
| `database/schema` | Koordinasi Adithya + Fadhil; PO review | ERD/migration contract dan data dictionary, bukan peran anggota baru |

## Domain database yang diharapkan dari proposal
`users`, `lahan`, `foto_lahan`, `rekomendasi`, `pengajuan`, `riwayat_status`, `verifikasi`, `foto_verifikasi`, `monitoring`. Detail kolom dan foreign key harus diselaraskan dengan ERD proposal sebelum implementasi migration. Jangan membuat migration duplikat di dua branch.

## Integrasi akhir
1. Setujui skema dan nama kolom.
2. Merge migration dan backend ke branch integrasi; jalankan migrate fresh pada DB pengujian.
3. Merge UI dan sambungkan Blade ke route/controller yang disepakati.
4. Tes use case, validasi role, upload file, peta, dan responsive UI.
5. PR final ke `main` setelah PO review. Tidak ada merge selama tahap setup/copy.
