@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-white px-4 py-8">

    <div class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-2 rounded-2xl shadow-[0_20px_50px_rgba(9,99,126,0.12)] overflow-hidden">

        <!-- GAMBAR (hidden di mobile) -->
        <div class="relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=700&q=85"
                 class="w-full h-full object-cover brightness-90">
            <div class="absolute inset-0 bg-gradient-to-b from-[#09637E]/50 via-[#09637E]/20 to-black/10"></div>
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
        <div class="bg-white px-5 py-6 sm:px-7 sm:py-7 flex flex-col justify-center">

            <!-- LOGO MOBILE -->
            <div class="md:hidden flex items-center justify-center gap-2 mb-4">
                <svg class="w-8 h-8 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z" />
                    <path d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                    <path fill-rule="evenodd"
                        d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-xl font-bold text-[#09637E]">MediTech</span>
            </div>

            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600 hover:bg-[#09637E]/10 hover:text-[#09637E] w-fit mb-3 transition">
                 ← Kembali ke Beranda
            </a>

            <h1 class="text-lg font-extrabold text-center text-[#09637E] mb-3">
                Daftar Akun
            </h1>

            @if(session('success'))
                <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 p-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 p-3 rounded-xl">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('registrasi.store') }}" onsubmit="return validateForm()" class="flex flex-col gap-2.5">
                @csrf

                <div>
                    <input name="no_identitas" type="text" id="no_identitas" placeholder="NIM / NIK"
                        value="{{ old('no_identitas') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                    <p id="error-no-identitas" class="text-red-500 text-xs hidden">Identitas wajib diisi</p>
                </div>

                <div>
                    <input name="email" type="email" id="email" placeholder="Email (contoh: andi@gmail.com)"
                         value="{{ old('email') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637ab]/40">
                    <p id="error-email" class="text-red-500 text-xs hidden">Email wajib diisi</p>
                </div>
                <div>
                    <input name="name" type="text" id="nama" placeholder="Nama lengkap"
                        value="{{ old('name') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                    <p id="error-nama" class="text-red-500 text-xs hidden">Nama wajib diisi</p>
                </div>

                <div>
                    <input name="alamat" type="text" id="alamat" placeholder="Alamat"
                        value="{{ old('alamat') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                    <p id="error-alamat" class="text-red-500 text-xs hidden">Alamat wajib diisi</p>
                </div>

                <div>
                    <label class="text-xs text-gray-500 ml-1">Kategori</label>
                    <select name="kategori" id="kategori"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                        <option value="">Pilih kategori</option>
                        <option value="Mahasiswa" {{ old('kategori') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="Dosen" {{ old('kategori') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="Staff TU" {{ old('kategori') == 'Staff TU' ? 'selected' : '' }}>Staff TU</option>
                    </select>
                    <p id="error-kategori" class="text-red-500 text-xs hidden">Kategori wajib dipilih</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs text-gray-500 ml-1">Tanggal lahir</label>
                        <input name="tgl_lahir" type="date" id="tanggal"
                            value="{{ old('tgl_lahir') }}"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                        <p id="error-tanggal" class="text-red-500 text-xs hidden">Tanggal lahir wajib diisi</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 ml-1">No HP</label>
                        <input name="no_hp" type="tel" id="nohp" placeholder="08xxxxxxxxxx"
                            value="{{ old('no_hp') }}"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                        <p id="error-nohp" class="text-red-500 text-xs hidden">No HP wajib diisi</p>
                    </div>
                </div>

                <div>
                    <input name="password" type="password" id="password" placeholder="Password"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                    <p id="error-password" class="text-red-500 text-xs hidden">Password wajib diisi</p>
                </div>

                <div>
                    <input name="password_confirmation" type="password" id="confirm" placeholder="Konfirmasi Password"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40">
                    <p id="error-confirm" class="text-red-500 text-xs hidden">Password tidak sama</p>
                </div>

                <button type="submit"
                        class="mt-2 py-2.5 rounded-xl text-sm text-white font-semibold bg-gradient-to-r from-[#09637E] to-[#0b7d9e] hover:opacity-90 transition">
                    Daftar
                </button>

                <p class="text-center text-xs text-gray-400 mt-1">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-[#09637E] font-semibold hover:underline">Masuk</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
function updateIdentitasLabel() {
    const kategori = document.getElementById('kategori').value;
    const input = document.getElementById('no_identitas');

    if (kategori === 'Mahasiswa') {
        input.placeholder = 'NIM Mahasiswa';
    } else if (kategori === 'Dosen' || kategori === 'Staff TU') {
        input.placeholder = 'NIK';
    } else {
        input.placeholder = 'NIM / NIK';
    }
}

document.getElementById('kategori').addEventListener('change', updateIdentitasLabel);
updateIdentitasLabel();

function validateForm() {
    let valid = true;
    function cek(id, errorId, message) {
        let input = document.getElementById(id);
        let error = document.getElementById(errorId);
        if (input.value.trim() === "") {
            error.textContent = message;
            error.classList.remove("hidden");
            input.classList.add("border-red-500");
            valid = false;
        } else {
            error.classList.add("hidden");
            input.classList.remove("border-red-500");
        }
    }
    cek("email", "error-email", "Email wajib diisi");
    cek("nama", "error-nama", "Nama wajib diisi");
    cek("alamat", "error-alamat", "Alamat wajib diisi");
    cek("kategori", "error-kategori", "Kategori wajib dipilih");
    cek("no_identitas", "error-no-identitas", "Identitas wajib diisi");
    cek("tanggal", "error-tanggal", "Tanggal wajib diisi");
    cek("nohp", "error-nohp", "No HP wajib diisi");
    cek("password", "error-password", "Password wajib diisi");
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm").value;
    let errorConfirm = document.getElementById("error-confirm");
    if (confirm !== password || confirm === "") {
        errorConfirm.textContent = "Password tidak sama";
        errorConfirm.classList.remove("hidden");
        document.getElementById("confirm").classList.add("border-red-500");
        valid = false;
    } else {
        errorConfirm.classList.add("hidden");
        document.getElementById("confirm").classList.remove("border-red-500");
    }
    return valid;
}
</script>

@endsection