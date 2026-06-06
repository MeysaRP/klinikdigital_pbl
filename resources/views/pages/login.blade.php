@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-8">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-3xl">

        <div class="grid grid-cols-1 md:grid-cols-2">

            <!-- KIRI (Gambar - hidden di mobile) -->
            <div class="relative hidden md:block md:min-h-[480px] lg:min-h-[520px] bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef');">

                <div class="absolute inset-0 bg-[#09637E] opacity-20"></div>

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
            <div class="p-6 sm:p-8 flex flex-col justify-center">

                <!-- LOGO MOBILE -->
                <div class="md:hidden flex items-center justify-center gap-2 mb-6">
                    <svg class="w-8 h-8 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z" />
                        <path d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        <path fill-rule="evenodd"
                            d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-xl font-bold text-[#09637E]">MediTech</span>
                </div>

                <h2 id="title" class="text-center text-[#09637E] font-bold text-xl mb-6">
                    MASUK PASIEN
                </h2>

                @if(session('success'))
                    <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 p-3 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-3 text-sm text-red-600 bg-red-50 border border-red-200 p-3 rounded-xl">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
                    @csrf

                    <select name="role" id="role" onchange="handleRoleChange()"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                        <option value="pasien" {{ old('role') === 'pasien' ? 'selected' : '' }}>Pasien</option>
                        <option value="dokter" {{ old('role') === 'dokter' ? 'selected' : '' }}>Dokter</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>

                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                         class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('email') border-red-500 @enderror">
                     @error('email')
                         <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    </div>

                    <!-- === PASSWORD (YANG DIUBAH) === -->
                    <div class="relative">
                        <input
                            type="password"
                            id="passwordInput"
                            name="password"
                            placeholder="Masukkan password"
                            class="w-full px-4 pr-12 py-2.5 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                            @error('password') border-red-500 @enderror"
                        >
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#09637E] transition-colors"
                            aria-label="Tampilkan password"
                        >
                            <svg id="iconEyeOpen" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <svg id="iconEyeClosed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"></path></svg>
                        </button>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <a href="{{ route('forgot.password') }}" class="text-sm text-[#09637E] hover:underline font-medium">
                            Lupa Password?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#09637E] hover:bg-[#074d61] text-white py-2.5 rounded-xl text-sm font-semibold shadow-md transition">
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
        const labels = { pasien: 'MASUK PASIEN', dokter: 'MASUK DOKTER', admin: 'MASUK ADMIN' };
        title.innerText = labels[role] || 'MASUK';
    }

    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const iconOpen = document.getElementById('iconEyeOpen');
        const iconClosed = document.getElementById('iconEyeClosed');

        if (input.type === 'password') {
            input.type = 'text';
            iconOpen.classList.add('hidden');
            iconClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            iconOpen.classList.remove('hidden');
            iconClosed.classList.add('hidden');
        }
    }
</script>
@endsection