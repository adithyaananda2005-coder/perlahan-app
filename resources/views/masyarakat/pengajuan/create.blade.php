<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Pengajuan - PERLAHAN</title>
</head>
<body>
    <h1>Buat Pengajuan</h1>

    @if (session('info'))
        <p>{{ session('info') }}</p>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <p>Periksa kembali data berikut:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('masyarakat.pengajuan.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        <div>
            <label for="judul">Judul pengajuan</label>
            <input
                id="judul"
                name="judul"
                type="text"
                value="{{ old('judul') }}"
                required
                maxlength="150"
            >
        </div>

        <br>

        <div>
            <label for="keterangan">Keterangan</label>
            <textarea
                id="keterangan"
                name="keterangan"
                required
                maxlength="5000"
            >{{ old('keterangan') }}</textarea>
        </div>

        <br>

        <div>
            <label for="dokumen">
                Dokumen pendukung (PDF/JPG/PNG, maksimal 5 MB)
            </label>
            <input
                id="dokumen"
                name="dokumen"
                type="file"
                accept=".pdf,.jpg,.jpeg,.png"
                required
            >
        </div>

        <br>

        <button type="submit">Kirim Pengajuan</button>
    </form>

    <p>
        <a href="{{ route('masyarakat.index') }}">
            Kembali ke dashboard
        </a>
    </p>
</body>
</html>
