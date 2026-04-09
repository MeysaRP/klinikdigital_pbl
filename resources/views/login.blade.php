<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-cover bg-center flex items-center justify-center"
      style="background-image: url('https://images.unsplash.com/photo-1629909613654-28e377c37b09');"

    <-- Overlay gelap -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Card Login -->
    <div class="relative bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-lg w-96">

        <h2 class="text-2xl font-bold text-center mb-6 text-green-700">
            Login Klinik
        </h2>

        <form>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" 
                       class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-green-400"
                       placeholder="Masukkan email">
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" 
                       class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-green-400"
                       placeholder="Masukkan password">
            </div>

            <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Login
            </button>

        </form>

        <p class="text-center mt-4 text-sm">
            Belum punya akun?
            <a href="/registrasi" class="text-green-600 font-semibold">
                Daftar
            </a>
        </p>

    </div>

</body>
</html>