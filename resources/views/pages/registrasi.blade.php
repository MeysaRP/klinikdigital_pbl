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

                <!-- ===== 1. KATEGORI ===== -->
                <div>
                    <label class="text-xs text-gray-500 ml-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" id="kategori"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('kategori') border-red-500 @enderror">
                        <option value="">-- Pilih kategori terlebih dahulu --</option>
                        <option value="Mahasiswa" {{ old('kategori') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="Dosen" {{ old('kategori') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="Staff TU" {{ old('kategori') == 'Staff TU' ? 'selected' : '' }}>Tenaga Kependidikan</option>
                    </select>
                    <p id="error-kategori" class="text-red-500 text-xs hidden">Kategori wajib dipilih</p>
                    @error('kategori')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 2. NO IDENTITAS ===== -->
                <div id="wrapper-no-identitas" class="hidden">
                    <label id="label-no-identitas" class="text-xs text-gray-500 ml-1">NIM / NIK <span class="text-red-500">*</span></label>
                    <input name="no_identitas" type="text" id="no_identitas" placeholder="NIM / NIK"
                        value="{{ old('no_identitas') }}"
                        inputmode="numeric"
                        maxlength="16"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('no_identitas') border-red-500 @enderror">
                    <p id="error-no-identitas" class="text-red-500 text-xs hidden">Identitas wajib diisi</p>
                    @error('no_identitas')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 3. EMAIL ===== -->
                <div>
                    <input name="email" type="email" id="email" placeholder="Email (contoh: andi@gmail.com)"
                        value="{{ old('email') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('email') border-red-500 @enderror">
                    <p id="error-email" class="text-red-500 text-xs hidden">Email wajib diisi</p>
                    @error('email')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 4. NAMA ===== -->
                <div>
                    <input name="name" type="text" id="nama" placeholder="Nama lengkap"
                        value="{{ old('name') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('name') border-red-500 @enderror">
                    <p id="error-nama" class="text-red-500 text-xs hidden">Nama wajib diisi</p>
                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 5. ALAMAT ===== -->
                <div>
                    <input name="alamat" type="text" id="alamat" placeholder="Alamat"
                        value="{{ old('alamat') }}"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('alamat') border-red-500 @enderror">
                    <p id="error-alamat" class="text-red-500 text-xs hidden">Alamat wajib diisi</p>
                    @error('alamat')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 6. JENIS KELAMIN ===== -->
                <div>
                    <label class="text-xs text-gray-500 ml-1">Jenis Kelamin</label>
                    <select name="jk" id="jk"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('jk') border-red-500 @enderror">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <p id="error-jk" class="text-red-500 text-xs hidden">Jenis kelamin wajib dipilih</p>
                    @error('jk')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 7. TANGGAL LAHIR & NO HP ===== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs text-gray-500 ml-1">Tanggal lahir</label>
                        <input name="tgl_lahir" type="date" id="tanggal"
                            value="{{ old('tgl_lahir') }}"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                            @error('tgl_lahir') border-red-500 @enderror">
                        <p id="error-tanggal" class="text-red-500 text-xs hidden">Tanggal lahir wajib diisi</p>
                        @error('tgl_lahir')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 ml-1">No HP</label>
                        <input name="no_hp" type="tel" id="nohp" placeholder="08xxxxxxxxxx"
                            value="{{ old('no_hp') }}"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                            @error('no_hp') border-red-500 @enderror">
                        <p id="error-nohp" class="text-red-500 text-xs hidden">No HP wajib diisi</p>
                        @error('no_hp')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ===== 8. PASSWORD ===== -->
                <div class="relative">
                    <input name="password" type="password" id="password" placeholder="Password"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm pr-10 focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('password') border-red-500 @enderror">
                    <button type="button" onclick="togglePassword('password','passwordIcon')"
                        class="absolute inset-y-0 right-2 flex items-center justify-center text-gray-500 hover:text-gray-700">
                        <svg id="passwordIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <p id="error-password" class="text-red-500 text-xs hidden">Password wajib diisi</p>
                    @error('password')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ===== 9. KONFIRMASI PASSWORD ===== -->
                <div class="relative">
                    <input name="password_confirmation" type="password" id="confirm" placeholder="Konfirmasi Password"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm pr-10 focus:outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E]/40
                        @error('password') border-red-500 @enderror">
                    <button type="button" onclick="togglePassword('confirm','confirmIcon')"
                        class="absolute inset-y-0 right-2 flex items-center justify-center text-gray-500 hover:text-gray-700">
                        <svg id="confirmIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
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
    
// ELEMEN
const kategoriSelect     = document.getElementById('kategori');
const wrapperNoIdentitas = document.getElementById('wrapper-no-identitas');
const labelNoIdentitas   = document.getElementById('label-no-identitas');
const inputNoIdentitas   = document.getElementById('no_identitas');

// KATEGORI → tampilkan/sembunyikan NIM atau NIK
function updateIdentitasField() {
    const kategori = kategoriSelect.value;

    if (!kategori) {
        wrapperNoIdentitas.classList.add('hidden');
        inputNoIdentitas.value = '';
        return;
    }

    wrapperNoIdentitas.classList.remove('hidden');

    if (kategori === 'Mahasiswa') {
        labelNoIdentitas.innerHTML = 'NIM <span class="text-red-500">*</span>';
        inputNoIdentitas.placeholder = 'Masukkan NIM (10 digit)';
        inputNoIdentitas.maxLength = 10;
    } else {
        labelNoIdentitas.innerHTML = 'NIK <span class="text-red-500">*</span>';
        inputNoIdentitas.placeholder = 'Masukkan NIK (16 digit)';
        inputNoIdentitas.maxLength = 16;
    }
}

kategoriSelect.addEventListener('change', updateIdentitasField);

// Hanya izinkan angka di input no_identitas
inputNoIdentitas.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Saat halaman pertama kali load, cek jika ada old value
document.addEventListener('DOMContentLoaded', function () {
    if (kategoriSelect.value) {
        updateIdentitasField();
    }
});

// TOGGLE PASSWORD
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l18 18" />';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
    }
}

// VALIDASI FORM
function validateForm() {
    let valid = true;

    function cek(id, errorId, message) {
        let input = document.getElementById(id);
        let error = document.getElementById(errorId);
        if (input.value.trim() === '') {
            error.textContent = message;
            error.classList.remove('hidden');
            input.classList.add('border-red-500');
            valid = false;
        } else {
            error.classList.add('hidden');
            input.classList.remove('border-red-500');
        }
    }

    // Kategori paling penting dicek duluan
    cek('kategori', 'error-kategori', 'Kategori wajib dipilih terlebih dahulu');

    // No identitas hanya dicek kalau wrapper-nya sudah tampil
    if (!wrapperNoIdentitas.classList.contains('hidden')) {
        let noIdVal   = inputNoIdentitas.value.trim();
        let kategori  = kategoriSelect.value;
        let errNoId   = document.getElementById('error-no-identitas');

        if (noIdVal === '') {
            errNoId.textContent = kategori === 'Mahasiswa' ? 'NIM wajib diisi!' : 'NIK wajib diisi!';
            errNoId.classList.remove('hidden');
            inputNoIdentitas.classList.add('border-red-500');
            valid = false;
        } else if (kategori === 'Mahasiswa' && noIdVal.length !== 10) {
            errNoId.textContent = 'NIM wajib 10 digit angka!';
            errNoId.classList.remove('hidden');
            inputNoIdentitas.classList.add('border-red-500');
            valid = false;
        } else if (kategori !== 'Mahasiswa' && noIdVal.length !== 16) {
            errNoId.textContent = 'NIK wajib 16 digit angka!';
            errNoId.classList.remove('hidden');
            inputNoIdentitas.classList.add('border-red-500');
            valid = false;
        } else {
            errNoId.classList.add('hidden');
            inputNoIdentitas.classList.remove('border-red-500');
        }
    } else {
        valid = false;
        kategoriSelect.focus();
        return false;
    }

    cek('email',  'error-email',  'Email wajib diisi');
    cek('nama',   'error-nama',   'Nama wajib diisi');
    cek('alamat', 'error-alamat', 'Alamat wajib diisi');
    cek('jk',     'error-jk',     'Jenis kelamin wajib dipilih');
    cek('tanggal','error-tanggal','Tanggal lahir wajib diisi');
    cek('nohp',   'error-nohp',   'No HP wajib diisi');
    cek('password','error-password','Password wajib diisi');

    let password    = document.getElementById('password').value;
    let confirm     = document.getElementById('confirm').value;
    let errorConfirm = document.getElementById('error-confirm');
    if (confirm !== password || confirm === '') {
        errorConfirm.textContent = 'Password tidak sama';
        errorConfirm.classList.remove('hidden');
        document.getElementById('confirm').classList.add('border-red-500');
        valid = false;
    } else {
        errorConfirm.classList.add('hidden');
        document.getElementById('confirm').classList.remove('border-red-500');
    }

    return valid;
}
</script>

@endsection