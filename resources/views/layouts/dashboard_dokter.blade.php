<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 flex flex-col min-h-screen">

<div class="flex flex-1">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-300 p-5 text-green-900">
        <h1 class="text-lg font-bold mb-6">MediTech</h1>

        <ul class="space-y-3">
            <li class="bg-green-400 text-white p-2 rounded">Dashboard</li>
            <li class="hover:bg-green-200 p-2 rounded">Jadwal Praktik</li>
            <li class="hover:bg-green-200 p-2 rounded">Booking Pasien</li>
            <li class="hover:bg-green-200 p-2 rounded">Daftar Pasien</li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-green-200 p-4 flex justify-between items-center shadow-sm">
            <h2 class="text-xl font-semibold text-green-900">Dashboard Dokter</h2>

            <div class="flex items-center gap-3">
                <span class="text-green-900">Halo, Dr. Budi</span>
                <img
                    src="https://ui-avatars.com/api/?name=Dr+Budi&background=16a34a&color=fff"
                    class="w-8 h-8 rounded-full"
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
<footer class="bg-green-200 py-4 text-center text-sm text-green-900">
    © 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02
</footer>

</body>
</html>