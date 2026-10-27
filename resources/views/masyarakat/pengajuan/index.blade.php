<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengajuan Saya - PERLAHAN</title>
</head>
<body>
    <h1>Pengajuan Saya</h1>

    @if (session('info'))
        <p>{{ session('info') }}</p>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('masyarakat.pengajuan.create') }}">
            Buat pengajuan
        </a>
    </p>

    @if (!empty($tableBelumTersedia) && $tableBelumTersedia)
        <p>
            Data pengajuan belum dapat ditampilkan karena tabel
            database masih menunggu integrasi.
        </p>
    @else
        @forelse ($pengajuan as $item)
            <article>
                <h2>{{ $item->nama_kegiatan }}</h2>

                <p>
                    <strong>Lahan:</strong>
                    {{ $item->lahan?->nama_lahan ?? 'Informasi lahan tidak tersedia' }}
                </p>

                <p>
                    <strong>Tanggal pengajuan:</strong>
                    {{ $item->tanggal_pengajuan?->format('d-m-Y') ?? '-' }}
                </p>

                <p>
                    <strong>Deskripsi:</strong>
                    {{ $item->deskripsi_kegiatan }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ ucfirst(str_replace('_', ' ', $item->status_pengajuan)) }}
                </p>

                @if ($item->alasan_penolakan)
                    <p>
                        <strong>Alasan penolakan:</strong>
                        {{ $item->alasan_penolakan }}
                    </p>
                @endif
            </article>
            <hr>
        @empty
            <p>Belum ada pengajuan.</p>
        @endforelse

        {{ $pengajuan->links() }}
    @endif

    <p>
        <a href="{{ route('masyarakat.index') }}">
            Kembali ke dashboard
        </a>
    </p>
</body>
</html>
