
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Lahan - PERLAHAN</title>
</head>
<body>
    <h1>{{ $lahan->nama }}</h1>
    <p>Lokasi: {{ $lahan->lokasi }}</p>

    <p>
        {{ $lahan->deskripsi ?? 'Belum ada deskripsi lahan.' }}
    </p>

    <a href="{{ route('masyarakat.lahan.index') }}">Kembali ke daftar lahan</a>
</body>
</html>
