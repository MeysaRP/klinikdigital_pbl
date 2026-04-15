<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function handleRoleChange() {
            const role = document.getElementById('role').value;
            const title = document.getElementById('title');

            if (role === 'pasien') {
                title.innerText = 'Login Pasien';
            } else if (role === 'dokter') {
                title.innerText = 'Login Dokter';
            } else {
                title.innerText = 'Login Admin';
            }
        }
    </script>
</head>

<body class="min-h-screen flex items-center justify-center relative">

    <!-- BACKGROUND (INI YANG DIGANTI) -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d"
            class="w-full h-full object-cover">
    </div>

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- CONTENT -->
    <div class="relative z-10 w-full flex justify-center px-4">

        <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-2xl">

            <div class="grid grid-cols-1 md:grid-cols-2">

                <!-- GAMBAR KIRI (TIDAK DIUBAH) -->
                <div class="relative min-h-[450px] bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef');">
                    <div class="absolute inset-0 bg-green-200 opacity-20"></div>
                </div>

                <!-- FORM (TIDAK DIUBAH) -->
                <div class="p-6">
                    <h2 id="title" class="text-center text-green-800 font-semibold tracking-widest mb-5">
                        LOGIN PASIEN
                    </h2>

                    <form method="POST" action="/login" class="space-y-3">
                        @csrf

                        <!-- DROPDOWN ROLE -->
                        <select id="role" name="role" onchange="handleRoleChange()"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">
                            <option value="pasien">Pasien</option>
                            <option value="dokter">Dokter</option>
                            <option value="admin">Admin</option>
                        </select>

                        <input type="text" name="username" placeholder="Username"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                        <input type="password" name="password" placeholder="Password"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                        <button type="submit"
                            class="w-full bg-green-400 hover:bg-green-500 text-white py-2 rounded">
                            Masuk
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</body>

</html>