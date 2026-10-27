
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Lahan - PERLAHAN</title>
</head>
<body>
    <h1>Informasi Lahan</h1>

    <p>
        <a href="{{ route('masyarakat.index') }}">Kembali ke dashboard</a>
    </p>

    @if (!empty($tableBelumTersedia) && $tableBelumTersedia)
        <p>
            Data lahan belum tersedia karena tabel database
            masih dalam proses integrasi.
        </p>
    @else
        <form method="GET" action="{{ route('masyarakat.lahan.index') }}">
            <input
                type="search"
                name="cari"
                value="{{ request('cari') }}"
                placeholder="Cari nama atau alamat lahan"
            >
            <button type="submit">Cari</button>
        </form>

        @forelse ($lahan as $item)
            <article>
                <h2>{{ $item->nama_lahan }}</h2>
                <p>Alamat: {{ $item->alamat }}</p>

                @if ($item->kota)
                    <p>Kota: {{ $item->kota }}</p>
                @endif

                @if ($item->luas)
                    <p>Luas: {{ $item->luas }} m²</p>
                @endif

                <a href="{{ route('masyarakat.lahan.show', $item->id) }}">
                    Lihat detail
                </a>
            </article>
        @empty
            <p>Belum ada lahan tersedia yang sesuai dengan pencarian.</p>
        @endforelse

        {{ $lahan->links() }}
    @endif
</body>
</html>
