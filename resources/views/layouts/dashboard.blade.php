<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 flex flex-col min-h-screen">

<div class="flex flex-1">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-300 p-5 text-green-900">
        <h1 class="text-lg font-bold mb-6">MediTech</h1>

        <ul class="space-y-3">
            <li class="bg-green-400 text-white p-2 rounded">Dashboard</li>
            <li class="hover:bg-green-200 p-2 rounded">Booking Jadwal</li>
            <li class="hover:bg-green-200 p-2 rounded">Data Dokter</li>
            <li class="hover:bg-green-200 p-2 rounded">Data Pasien</li>
            <li class="hover:bg-green-200 p-2 rounded">Resep</li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-green-200 p-4 flex justify-between items-center shadow-sm">
            <h2 class="text-xl font-semibold text-green-900">Dashboard</h2>

            <div class="flex items-center gap-3">
                <span class="text-green-900">Halo, Admin</span>

                <img
                    src="https://ui-avatars.com/api/?name=Admin&background=16a34a&color=fff"
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
<footer class="bg-green-200 py-4 text-center text-sm text-green-900">
    © 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02
</footer>

</body>
</html>