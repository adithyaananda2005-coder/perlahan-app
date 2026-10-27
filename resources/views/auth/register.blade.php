<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Masyarakat - PERLAHAN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background: white;
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 16px #00000012;
            box-sizing: border-box;
        }

        h1 { color: #246b45; text-align: center; }
        p { color: #555; text-align: center; }
        label { display: block; margin-top: 16px; }

        input {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 12px;
            background: #246b45;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .error { color: #b42318; font-size: 14px; }
        .link { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <h1>PERLAHAN</h1>
        <p>Registrasi Akun Masyarakat</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <label for="name">Nama lengkap</label>
            <input id="name" type="text" name="name"
                   value="{{ old('name') }}" required autocomplete="name">

            <label for="email">Email</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required autocomplete="email">

            <label for="password">Password (minimal 8 karakter)</label>
            <input id="password" type="password" name="password"
                   required minlength="8" autocomplete="new-password">

            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" type="password"
                   name="password_confirmation" required minlength="8"
                   autocomplete="new-password">

            <button type="submit">Daftar Sekarang</button>
        </form>

        <div class="link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>
