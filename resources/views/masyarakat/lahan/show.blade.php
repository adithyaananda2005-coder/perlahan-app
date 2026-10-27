<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Lahan - PERLAHAN</title>
</head>
<body>
    <h1>{{ $lahan->nama_lahan }}</h1>

    <p><strong>Kode lahan:</strong> {{ $lahan->kode_lahan }}</p>
    <p><strong>Alamat:</strong> {{ $lahan->alamat }}</p>

    @if ($lahan->kota)
        <p><strong>Kota:</strong> {{ $lahan->kota }}</p>
    @endif

    @if ($lahan->luas)
        <p><strong>Luas:</strong> {{ $lahan->luas }} m²</p>
    @endif

    <p>
        <strong>Status:</strong>
        {{ ucfirst(str_replace('_', ' ', $lahan->status)) }}
    </p>

    <p>
        {{ $lahan->deskripsi ?? 'Belum ada deskripsi lahan.' }}
    </p>

    <a href="{{ route('masyarakat.lahan.index') }}">
        Kembali ke daftar lahan
    </a>
</body>
</html>
