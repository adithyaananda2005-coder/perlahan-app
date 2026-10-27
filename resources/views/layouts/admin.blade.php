
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin PERLAHAN')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, #285333, #20452c);
        }

        .page-bg {
            background: #f5f8f5;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 12px;
            color: #d5e4d7;
            font-size: 14px;
            font-weight: 600;
            transition: background .2s;
        }

        .menu-link:hover,
        .menu-active {
            background: rgba(255, 255, 255, .13);
            color: white;
        }

        .stat-card {
            background: white;
            border: 1px solid #e0e8e1;
            border-radius: 17px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(30, 60, 40, .035);
        }
    </style>
</head>

<body class="page-bg text-slate-800">

<div class="min-h-screen md:flex">

    <!-- SIDEBAR -->
    <aside class="sidebar flex w-full flex-col text-white md:fixed md:inset-y-0 md:left-0 md:w-[326px]">

        <div class="border-b border-white/15 px-7 py-7">
            <div class="flex h-[120px] w-[132px] items-center justify-center rounded-xl bg-white p-2">
                <div class="text-center">
                    <div class="mb-1 text-4xl text-green-800">
                        <i data-lucide="sprout" class="mx-auto h-12 w-12"></i>
                    </div>
                    <div class="text-xl font-extrabold tracking-tight text-slate-800">
                        PERLAHAN
                    </div>
                    <div class="text-[7px] text-slate-500">
                        Platform Pengelolaan dan Pemanfaatan Lahan
                    </div>
                </div>
            </div>
        </div>

        <div class="px-5 py-6">
            <div class="flex items-center gap-3 rounded-xl bg-white/10 p-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-100 font-bold text-green-900">
                    PA
                </div>
                <div>
                    <p class="text-sm font-bold">Pemerintah / Admin</p>
                    <p class="mt-1 text-xs text-green-200">Portal PERLAHAN</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-5 pb-5">
            <p class="mb-3 px-3 text-[11px] font-bold tracking-widest text-green-200/70">
                MENU UTAMA
            </p>

            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="menu-link menu-active">
                    <i data-lucide="layout-dashboard" class="h-6 w-6"></i>
                    Dashboard
                </a>

<a href="{{ route('admin.lahan') }}"
   class="menu-link {{ request()->routeIs('admin.lahan') ? 'menu-active' : '' }}">
    <i data-lucide="trees" class="h-6 w-6"></i>
    Data Lahan
</a>

                <a href="#" class="menu-link">
                    <i data-lucide="map" class="h-6 w-6"></i>
                    Peta Lahan
                </a>

                <a href="#" class="menu-link">
                    <i data-lucide="file-text" class="h-6 w-6"></i>
                    Pengajuan
                </a>

                <a href="#" class="menu-link">
                    <i data-lucide="clipboard-check" class="h-6 w-6"></i>
                    Verifikasi Lapangan
                </a>

                <a href="#" class="menu-link">
                    <i data-lucide="activity" class="h-6 w-6"></i>
                    Monitoring
                </a>

                <a href="#" class="menu-link">
                    <i data-lucide="users" class="h-6 w-6"></i>
                    Pengguna
                </a>

                <a href="#" class="menu-link">
                    <i data-lucide="history" class="h-6 w-6"></i>
                    Riwayat Data
                </a>
            </div>
        </nav>

        <div class="border-t border-white/10 p-6">
            <div class="mb-7 flex items-center gap-3">
                <i data-lucide="leaf" class="h-7 w-7 text-green-300"></i>
                <div>
                    <p class="text-xs font-bold">Mendukung SDG 15</p>
                    <p class="mt-1 text-xs text-green-200">Life on Land</p>
                </div>
            </div>

            <a href="#" class="menu-link">
                <i data-lucide="log-out" class="h-6 w-6"></i>
                Keluar
            </a>
        </div>

    </aside>

    <!-- KONTEN UTAMA -->
    <div class="min-w-0 flex-1 md:ml-[326px]">

        <!-- NAVBAR -->
        <header class="sticky top-0 z-20 flex min-h-[95px] flex-wrap items-center justify-between gap-4 border-b border-slate-100 bg-white px-6 py-4 lg:px-9">

            <div>
                <p class="mb-1 text-xs text-slate-400">Portal / Dashboard</p>
                <h2 class="text-lg font-bold text-slate-800">
                    @yield('page-heading', 'Dashboard')
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 sm:flex">
                    <i data-lucide="search" class="h-5 w-5 text-slate-400"></i>
                    <input
                        type="search"
                        placeholder="Cari data, lahan..."
                        class="w-44 border-0 bg-transparent text-sm outline-none placeholder:text-slate-300 lg:w-52"
                    >
                </div>

                <button type="button" aria-label="Notifikasi"
                    class="relative rounded-xl border border-slate-200 p-3">
                    <i data-lucide="bell" class="h-5 w-5 text-slate-600"></i>
                    <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
                </button>

                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-sm font-bold text-green-800">
                        AR
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-bold">Arif Rahman</p>
                        <p class="mt-1 text-xs text-slate-400">Pemerintah / Admin</p>
                    </div>
                    <i data-lucide="chevron-down" class="hidden h-5 w-5 sm:block"></i>
                </div>
            </div>
        </header>

        <!-- ISI HALAMAN -->
        <main class="min-h-screen p-5 sm:p-7 lg:p-9">
            @yield('content')
        </main>

    </div>
</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
