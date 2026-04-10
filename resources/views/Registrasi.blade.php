<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center relative">

    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bg-klinik.jpg') }}" 
             class="w-full h-full object-cover">
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-green-200 opacity-70"></div>

    <!-- Card -->
    <div class="relative bg-white p-8 rounded-2xl shadow-lg w-full max-w-md z-10">

        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">
            Registrasi
        </h2>

        <form action="{{ route('registrasi.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="username" placeholder="Username"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <input type="text" name="name" placeholder="Nama Lengkap"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <input type="text" name="alamat" placeholder="Alamat"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <input type="date" name="tgl_lahir"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <input type="text" name="no_hp" placeholder="No HP"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300">

            <button type="submit"
                class="w-full bg-green-400 hover:bg-green-500 text-white py-2 rounded-lg">
                Daftar
            </button>
        </form>

    </div>

</body>
</html>