
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Lahan - PERLAHAN</title>
</head>
<body>
    <h1>Informasi Lahan</h1>

    <form method="GET" action="{{ route('masyarakat.lahan.index') }}">
        <input type="search" name="q" value="{{ request('q') }}"
               placeholder="Cari nama atau lokasi lahan">
        <button type="submit">Cari</button>
    </form>

    @forelse ($lahan as $item)
        <article>
            <h2>{{ $item->nama }}</h2>
            <p>Lokasi: {{ $item->lokasi }}</p>
            <a href="{{ route('masyarakat.lahan.show', $item->id) }}">
                Lihat detail
            </a>
        </article>
    @empty
        <p>Belum ada data lahan yang tersedia.</p>
    @endforelse

    @if (is_object($lahan) && method_exists($lahan, 'links'))
    {{ $lahan->links() }}
@endif

    <p><a href="{{ route('masyarakat.index') }}">Kembali ke dashboard</a></p>
    @if (!empty($tableBelumTersedia) && $tableBelumTersedia)
    <p>
        Data lahan belum tersedia karena tabel database
        masih dalam proses integrasi.
    </p>
@else
    {{-- Daftar lahan yang sudah ada tetap ditampilkan di sini. --}}
@endif
</body>
</html>
