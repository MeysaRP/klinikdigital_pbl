<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-green-50">

    <body class="min-h-screen flex items-center justify-center relative">

        <!-- BACKGROUND -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7" class="w-full h-full object-cover">
        </div>

        <!-- OVERLAY BLUR HITAM -->
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

        <!-- CONTENT -->
        <div class="relative z-10 w-full flex justify-center px-4">

            <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-2xl">

                <div class="grid grid-cols-1 md:grid-cols-2">

                    <!-- GAMBAR KIRI -->
                    <div class="relative min-h-[450px] bg-cover bg-center"
                        style="background-image: url('https://media.istockphoto.com/id/1529989893/id/foto/dokter-memegang-pena-menulis-daftar-riwayat-pasien-di-clipboard-tentang-pengobatan-dan.jpg?s=612x612&w=is&k=20&c=wfWBMI35epTyKIZca_WBDBvDJOwV_uM_Vl1HBDtYdkg=');">
                        <div class="absolute inset-0 bg-green-200 opacity-20"></div>
                    </div>
                    <!-- FORM -->
                    <div class="p-6">
                        <h2 class="text-center text-green-800 font-semibold tracking-widest mb-5">
                            DAFTAR
                        </h2>

                        <form action="{{ route('registrasi.store') }}" method="POST" class="space-y-3">
                            @csrf

                            <input type="text" name="username" placeholder="Username"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <input type="text" name="name" placeholder="Nama lengkap"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <input type="text" name="alamat" placeholder="Alamat"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <input type="date" name="tgl_lahir"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <input type="text" name="no_hp" placeholder="No HP"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <input type="password" name="password" placeholder="Password"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-300">

                            <button type="submit"
                                class="w-full bg-green-400 hover:bg-green-500 text-white py-2 rounded">
                                Daftar
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </body>

</html>