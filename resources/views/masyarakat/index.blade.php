<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat - PERLAHAN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6f4;
            color: #26352c;
        }

        header {
            background: #246b45;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        main {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome,
        .feature {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px #0000000a;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .feature h3 {
            color: #246b45;
        }

        .logout-button {
            padding: 10px 16px;
            background: white;
            color: #246b45;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .notice {
            color: #5b665f;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <header>
        <h1>PERLAHAN</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-button" type="submit">
                Logout
            </button>
        </form>
    </header>

    <main>
        <section class="welcome">
            <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
            <p>
                Anda berhasil masuk ke dashboard masyarakat PERLAHAN.
            </p>
            <p class="notice">
                PERLAHAN membantu masyarakat mengakses informasi
                lahan dan layanan pengajuan secara lebih mudah.
            </p>
        </section>


        <section class="features">
            <div class="feature">
                <h3>Profil Saya</h3>
                <p>Lihat dan perbarui informasi akun Anda.</p>
                <a href="{{ route('masyarakat.profil.show') }}">
                    Buka profil
                </a>
            </div>

            <div class="feature">
                <h3>Informasi Lahan</h3>
                <p>Lihat dan cari informasi lahan yang tersedia.</p>
                <a href="{{ route('masyarakat.lahan.index') }}">
                    Lihat daftar lahan
                </a>
            </div>

            <div class="feature">
                <h3>Buat Pengajuan</h3>
                <p>Ajukan permohonan lahan melalui sistem.</p>
                <a href="{{ route('masyarakat.pengajuan.create') }}">
                    Buat pengajuan
                </a>
            </div>

            <div class="feature">
                <h3>Riwayat Pengajuan</h3>
                <p>Lihat pengajuan dan pantau statusnya.</p>
                <a href="{{ route('masyarakat.pengajuan.index') }}">
                    Lihat riwayat
                </a>
            </div>
        </section>
    </main>
</body>

</html>