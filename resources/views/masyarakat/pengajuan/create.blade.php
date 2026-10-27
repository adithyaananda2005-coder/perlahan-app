<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Pengajuan - PERLAHAN</title>
</head>
<body>
    <h1>Buat Pengajuan Pemanfaatan Lahan</h1>

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
            <label for="lahan_id">Pilih lahan</label>
            <select id="lahan_id" name="lahan_id" required>
                <option value="">-- Pilih lahan --</option>

                @foreach ($lahan as $item)
                    <option
                        value="{{ $item->id }}"
                        @selected(old('lahan_id') == $item->id)
                    >
                        {{ $item->nama_lahan }} — {{ $item->alamat }}
                    </option>
                @endforeach
            </select>

            @if ($lahan->isEmpty())
                <p>Belum ada lahan tersedia untuk dipilih.</p>
            @endif
        </div>

        <br>

        <div>
            <label for="nama_kegiatan">Nama kegiatan</label>
            <input
                id="nama_kegiatan"
                name="nama_kegiatan"
                type="text"
                value="{{ old('nama_kegiatan') }}"
                required
                maxlength="255"
            >
        </div>

        <br>

        <div>
            <label for="deskripsi_kegiatan">Deskripsi kegiatan</label>
            <textarea
                id="deskripsi_kegiatan"
                name="deskripsi_kegiatan"
                required
                maxlength="5000"
            >{{ old('deskripsi_kegiatan') }}</textarea>
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

        <button
            type="submit"
            @disabled($lahan->isEmpty())
        >
            Kirim Pengajuan
        </button>
    </form>

    <p>
        <a href="{{ route('masyarakat.index') }}">
            Kembali ke dashboard
        </a>
    </p>
</body>
</html>
