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
                <h2>{{ $item->judul }}</h2>
                <p>{{ $item->keterangan }}</p>
                <p>Status: {{ $item->status ?? 'Menunggu proses' }}</p>
            </article>
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