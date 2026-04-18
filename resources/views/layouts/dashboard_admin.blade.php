<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light flex flex-col min-h-screen">

<div class="flex flex-1">

    <!-- SIDEBAR -->
    <div class="w-64 bg-primary p-5 text-white">
        <h1 class="text-lg font-bold mb-6">MediTech</h1>

        <ul class="space-y-3">
            <li class="bg-secondary p-2 rounded">Dashboard</li>
            <li class="hover:bg-secondary/70 p-2 rounded">Data Dokter</li>
            <li class="hover:bg-secondary/70 p-2 rounded">Data Pasien</li>
            <li class="hover:bg-secondary/70 p-2 rounded">Data Jadwal</li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-white p-4 flex justify-between items-center shadow-sm">
            <h2 class="text-xl font-semibold text-primary">Dashboard</h2>

            <div class="flex items-center gap-3">
                <span class="text-primary">Halo, Admin</span>

                <img
                    src="https://ui-avatars.com/api/?name=Admin&background=09637E&color=fff"
                    class="w-8 h-8 rounded-full"
                    alt="profile"
                >
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-6 flex-1">
            @yield('content')
        </div>

    </div>

</div>

<!-- FOOTER -->
<footer class="bg-primary py-4 text-center text-sm text-white">
    © 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02
</footer>

</body>
</html>