<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>MediTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">

<!-- Navbar -->
<nav class="bg-green-200 px-6 py-3 flex justify-between items-center shadow-sm">
    <h1 class="font-semibold text-lg text-green-900">MediTech</h1>
    <div class="flex gap-4 text-green-900">
        <a href="/" class="hover:underline">Beranda</a>
        <a href="/registrasi" class="hover:underline">Registrasi</a>
        <a href="/login" class="bg-green-400 px-4 py-1 rounded-full text-white">
            Login
        </a>
    </div>
</nav>

<!-- Content -->
@yield('content')

<!-- Footer -->
<footer class="bg-green-200 mt-10 py-4 text-center text-sm text-green-900">
    © 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02
</footer>

</body>
</html>