@extends('layouts.auth')

@section('content')

    <div class="min-h-screen flex items-center justify-center">

        <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-3xl">

            <div class="grid grid-cols-1 md:grid-cols-2">

                <!-- KIRI (GAMBAR) -->
                <div class="relative min-h-[400px] bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef');">
                    <div class="absolute inset-0 bg-primary opacity-20"></div>
                </div>

                <div class="p-8 flex flex-col">

                    <h2 id="title" class="text-center text-primary font-bold text-xl mb-6">
                        MASUK PASIEN
                    </h2>

                    <form method="POST" action="{{ route('login.process') }}" class="space-y-4 flex flex-col">
                        @csrf

                        <select id="role" onchange="handleRoleChange()"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary">
                            <option value="pasien">Pasien</option>
                            <option value="dokter">Dokter</option>
                            <option value="admin">Admin</option>
                        </select>

                        <input type="text" name="username" placeholder="Masukkan username"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary">

                        <input type="password" name="password" placeholder="Masukkan password"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary">

                        <!-- LUPA PASSWORD -->
                        <a href="{{ route('forgot.password') }}" class="text-sm text-primary hover:underline">
                            Lupa Password?
                        </a>

                        <!-- TOMBOL -->
                        <button type="submit"
                            class="mt-2 w-full bg-primary hover:bg-secondary text-white py-2.5 rounded-lg font-semibold shadow-md">
                            MASUK
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function handleRoleChange() {
            const role = document.getElementById('role').value;
            const title = document.getElementById('title');

            if (role === 'pasien') {
                title.innerText = 'MASUK PASIEN';
            } else if (role === 'dokter') {
                title.innerText = 'MASUK DOKTER';
            } else {
                title.innerText = 'MASUK ADMIN';
            }
        }
    </script>

@endsection