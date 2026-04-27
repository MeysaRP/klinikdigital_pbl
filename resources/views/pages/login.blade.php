@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-3xl">

        <div class="grid grid-cols-1 md:grid-cols-2">

            <!-- KIRI -->
            <div class="relative min-h-[400px] bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef');">
                
                <div class="absolute inset-0 bg-primary opacity-20"></div>

                <!-- LOGO -->
                <div class="absolute top-4 left-4 flex items-center gap-2 bg-white/80 px-3 py-1 rounded-lg shadow">
                    <svg class="w-6 h-6 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z" />
                        <path d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        <path fill-rule="evenodd"
                            d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-semibold text-[#09637E]">MediTech</span>
                </div>

            </div>

            <!-- FORM -->
            <div class="p-8 flex flex-col">

                <h2 id="title" class="text-center text-primary font-bold text-xl mb-6">
                    MASUK PASIEN
                </h2>

                <!-- ERROR LOGIN -->
                @if(session('error'))
                    <div class="mb-3 text-sm text-red-600 bg-red-100 p-2 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
                    @csrf

                    <!-- ROLE -->
                    <select name="role" id="role" onchange="handleRoleChange()"
                        class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary">

                        <option value="pasien">Pasien</option>
                        <option value="dokter">Dokter</option>
                        <option value="admin">Admin</option>

                    </select>

                    <!-- USERNAME -->
                    <div>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary
                            @error('username') border-red-500 @enderror">

                        @error('username')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <input type="password" name="password" placeholder="Masukkan password" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary
                            @error('password') border-red-500 @enderror">

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- LUPA PASSWORD -->
                    <a href="{{ route('forgot.password') }}" class="text-sm text-primary hover:underline">
                        Lupa Password?
                    </a>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-primary hover:bg-secondary text-white py-2.5 rounded-lg font-semibold shadow-md">
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