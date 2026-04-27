<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - MediTech' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #09637E; border-radius: 3px; }
    </style>
</head>
<body class="bg-gray-100 antialiased">

<div class="flex h-screen overflow-hidden">
    @yield('sidebar')

    <div class="flex flex-col flex-1 ml-64">
        <!-- TOPBAR (STANDAR SESUAI PASIEN) -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200">
            <div class="px-6 py-3 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">{{ $pageTitle ?? 'Dashboard' }}</h2>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900">{{ $userName ?? 'User' }}</p>
                        <p class="text-xs text-gray-500">{{ $userRole ?? 'Role' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#09637E] flex items-center justify-center text-white font-bold shadow-md border-2 border-white">
                        {{ $userInitial ?? 'U' }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
            @yield('content')
        </main>

        <footer class="bg-[#09637E] p-4 text-center">
            <span class="text-xs text-white/70">© 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02</span>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>