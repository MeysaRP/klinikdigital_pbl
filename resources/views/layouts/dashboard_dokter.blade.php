<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - MediTech</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #09637E; border-radius: 3px; }
    </style>
</head>

<body class="bg-gray-100 antialiased">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
   <aside class="fixed top-0 left-0 w-64 h-full bg-white border-r border-gray-200 p-5 flex flex-col">

    <!-- LOGO -->
    <h1 class="text-xl font-bold text-[#09637E] mb-8">
        MediTech
    </h1>

    <!-- MENU -->
    <ul class="space-y-2 text-sm flex-1">

        <!-- Dashboard -->
        <li>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-[#09637E] text-white font-semibold">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Dashboard
            </a>
        </li>

        <!-- Jadwal -->
        <li>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1z"/>
                </svg>
                Jadwal Praktik
            </a>
        </li>

        <!-- Pasien -->
        <li>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                </svg>
                Daftar Pasien
            </a>
        </li>

        <!-- Profil -->
        <li>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                </svg>
                Profil
            </a>
        </li>

    </ul>

    <!-- LOGOUT -->
    <div class="pt-4 border-t border-gray-100">
        <button class="flex items-center gap-3 w-full p-3 text-red-600 rounded-xl hover:bg-red-50 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Logout
        </button>
    </div>
</aside>

    <!-- MAIN -->
    <div class="flex flex-col flex-1 ml-64">

        <!-- TOPBAR -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200">
            <div class="px-6 py-3 flex items-center justify-between">

                <h2 class="text-xl font-bold text-gray-800">
                    Dashboard Dokter
                </h2>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900">
                            Dr. Sarah Wijaya
                        </p>
                        <p class="text-xs text-gray-500">
                            Dokter
                        </p>
                    </div>

                    <!-- AVATAR TANPA ICON -->
                    <div class="w-10 h-10 rounded-full bg-[#09637E] text-white flex items-center justify-center font-bold shadow-md border-2 border-white">
                        DS
                    </div>
                </div>

            </div>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="bg-[#09637E] p-4 text-center">
            <span class="text-sm text-white/70">
                © 2026 Politeknik Negeri Batam - Projek PBL
            </span>
        </footer>

    </div>

</div>

</body>
</html>