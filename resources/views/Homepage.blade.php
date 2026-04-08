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
    <div class="flex gap-4 items-center text-green-900">
        <a href="#" class="hover:underline">Beranda</a>
        <a href="#" class="hover:underline">Tentang</a>
        <a href="#" class="hover:underline">Registrasi</a>
        <a href="#" class="bg-green-400 hover:bg-green-500 px-4 py-1 rounded-full text-white">
            Login
        </a>
    </div>
</nav>

<!-- HERO -->
<section class="max-w-5xl mx-auto mt-8 px-4">
    <div class="relative h-64 md:h-80 rounded-lg overflow-hidden shadow">

        <!-- Gambar klinik -->
        <img 
            src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3"
            class="w-full h-full object-cover"
        >

        <!-- Overlay -->
        <div class="absolute inset-0 bg-green-900 bg-opacity-50"></div>

        <!-- Text -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-xl md:text-2xl text-white font-semibold">
                Selamat Datang di MediTech Klinik Digital
            </h1>
            <p class="text-white mt-2 text-sm md:text-base">
                Solusi kesehatan modern untuk Anda
            </p>
        </div>

    </div>
</section>

<!-- TENTANG -->
<section class="text-center mt-10">
    <h2 class="font-semibold tracking-widest text-green-800">
        TENTANG
    </h2>
</section>

<!-- CARD FITUR -->
<section class="max-w-5xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-3 gap-6 px-4">
    
    <div class="bg-green-100 h-32 rounded-lg shadow flex items-center justify-center">
        <p class="text-green-800 font-medium">Konsultasi Online</p>
    </div>

    <div class="bg-green-100 h-32 rounded-lg shadow flex items-center justify-center">
        <p class="text-green-800 font-medium">Dokter Profesional</p>
    </div>

    <div class="bg-green-100 h-32 rounded-lg shadow flex items-center justify-center">
        <p class="text-green-800 font-medium">Akses Mudah</p>
    </div>

</section>

<!-- FOOTER -->
<footer class="bg-green-200 mt-10 py-4 text-center text-sm text-green-900">
    © 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02
</footer>

</body>
</html>