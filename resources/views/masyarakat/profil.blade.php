<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Masyarakat</title>
</head>
<body>
    <h1>Profil Saya</h1>

    <a href="{{ route('masyarakat.index') }}">Kembali ke Dashboard</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('masyarakat.profil.update') }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nama</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
            >
        </div>

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
            >
        </div>

        <hr>

        <p>Kosongkan password jika tidak ingin mengubahnya.</p>


<div>
    <label for="password">Password baru</label>
    <input
        type="password"
        id="password"
        name="password"
        autocomplete="new-password"
    >
</div>

<div>
    <label for="password_confirmation">Konfirmasi password baru</label>
    <input
        type="password"
        id="password_confirmation"
        name="password_confirmation"
        autocomplete="new-password"
    >
</div>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
