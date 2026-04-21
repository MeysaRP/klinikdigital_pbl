@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-white px-4">

    <div class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-2 rounded-2xl shadow-[0_20px_50px_rgba(9,99,126,0.12)] overflow-hidden">

        <!-- LEFT IMAGE -->
        <div class="relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=700&q=85"
                 class="w-full h-full object-cover brightness-90">

            <div class="absolute inset-0 bg-gradient-to-b from-[#09637E]/50 via-[#09637E]/20 to-black/10"></div>
        </div>

        <!-- FORM -->
        <div class="bg-white px-5 py-6 md:px-7 md:py-7 flex flex-col justify-center">

            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600 hover:bg-[#09637E]/10 hover:text-[#09637E] w-fit mb-3 transition">
                 ← Kembali ke Beranda
            </a>

            <h1 class="text-lg font-extrabold text-center text-[#09637E] mb-3">
                Daftar Akun
            </h1>

            <form onsubmit="return validateForm()" class="flex flex-col gap-2.5">

                <div>
                    <input type="text" id="username" placeholder="Username"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-username" class="text-red-500 text-xs hidden">Username wajib diisi</p>
                </div>

                <div>
                    <input type="text" id="nama" placeholder="Nama lengkap"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-nama" class="text-red-500 text-xs hidden">Nama wajib diisi</p>
                </div>

                <div>
                    <input type="text" id="alamat" placeholder="Alamat"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-alamat" class="text-red-500 text-xs hidden">Alamat wajib diisi</p>
                </div>

                <div class="grid grid-cols-2 gap-2">

              <div>
                 <label class="text-xs text-gray-500 ml-1">Tanggal lahir</label>
                    <input type="date" id="tanggal"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-tanggal" class="text-red-500 text-xs hidden">Tanggal lahir wajib diisi</p>
                </div>

            <div>
                 <label class="text-xs text-gray-500 ml-1">No HP</label>
                    <input type="tel" id="nohp" placeholder="08xxxxxxxxxx"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-nohp" class="text-red-500 text-xs hidden">No HP wajib diisi</p>
                </div>

                <div>
                    <input type="password" id="password" placeholder="Password"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-password" class="text-red-500 text-xs hidden">Password wajib diisi</p>
                </div>

                <div>
                    <input type="password" id="confirm" placeholder="Konfirmasi Password"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                    <p id="error-confirm" class="text-red-500 text-xs hidden">Password tidak sama</p>
                </div>

                <button type="submit"
                        class="mt-2 py-2.5 rounded-lg text-sm text-white font-semibold bg-gradient-to-r from-[#09637E] to-[#0b7d9e] hover:opacity-90 transition">
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

    cek("username", "error-username", "Username wajib diisi");
    cek("nama", "error-nama", "Nama wajib diisi");
    cek("alamat", "error-alamat", "Alamat wajib diisi");
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