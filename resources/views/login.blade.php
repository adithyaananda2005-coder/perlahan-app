
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PERLAHAN</title>
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
            max-width: 400px;
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
        <p>Login ke Akun Anda</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
            >

            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            >

            <label>
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    style="width:auto"
                >
                Ingat saya
            </label>

            <button type="submit">Login</button>
        </form>

        <div class="link">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</body>
</html>
