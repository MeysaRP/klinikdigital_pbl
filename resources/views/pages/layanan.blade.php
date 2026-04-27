@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#09637E]/5 rounded-full filter blur-3xl -z-0 transform translate-x-1/2 -translate-y-1/2"></div>

    <div class="max-w-screen-xl mx-auto px-4 py-16 lg:py-20 relative z-10 text-center">
        <p class="text-sm font-semibold text-[#09637E] uppercase tracking-wider mb-3">Layanan Kami</p>
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-tight text-gray-900 md:text-5xl">
            Solusi Kesehatan <span class="text-[#09637E]">Digital</span>
        </h1>
        <p class="text-lg font-light text-gray-500 max-w-2xl mx-auto">
            Kami menyediakan berbagai layanan kesehatan yang dapat diakses secara digital untuk kemudahan Anda.
        </p>
    </div>
</section>

<!-- LAYANAN UTAMA -->
<section class="bg-gray-50 py-20 border-t border-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

            <!-- Layanan 1 -->
            <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900">Pemesanan Jadwal Online</h3>
                <p class="text-gray-500 leading-relaxed mb-4">Daftar antrean dan pilih jadwal dokter dengan mudah tanpa harus mengantri secara langsung di klinik.</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Pilih dokter sesuai kebutuhan</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Lihat ketersediaan jadwal realtime</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Konfirmasi instan via sistem</li>
                </ul>
            </div>

            <!-- Layanan 2 -->
            <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900">Dokter Profesional</h3>
                <p class="text-gray-500 leading-relaxed mb-4">Tenaga medis bersertifikat dan berpengalaman di bidangnya siap melayani kebutuhan kesehatan Anda.</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Dokter umum & spesialis</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Jadwal praktek teratur</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Profil dokter transparan</li>
                </ul>
            </div>

            <!-- Layanan 3 -->
            <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-100 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900">Rekam Medis Digital</h3>
                <p class="text-gray-500 leading-relaxed mb-4">Riwayat kesehatan tersimpan rapi dan mudah diakses kapan saja melalui sistem digital.</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Riwayat lengkap & terstruktur</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Unduh dalam format PDF</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Data aman & terenkripsi</li>
                </ul>
            </div>

            <!-- Layanan 4 -->
            <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900">Manajemen Antrian</h3>
                <p class="text-gray-500 leading-relaxed mb-4">Sistem antrian digital yang terintegrasi untuk mengurangi waktu tunggu pasien di klinik.</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>No. antrian otomatis</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Monitoring status realtime</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Notifikasi saat giliran</li>
                </ul>
            </div>

            <!-- Layanan 5 -->
            <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900">Keamanan Data</h3>
                <p class="text-gray-500 leading-relaxed mb-4">Data medis pasien dilindungi dengan sistem keamanan berlapis untuk menjaga privasi.</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Enkripsi data pasien</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Akses terbatas per role</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Backup data rutin</li>
                </ul>
            </div>

            <!-- Layanan 6 -->
            <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900">Akses Multi Platform</h3>
                <p class="text-gray-500 leading-relaxed mb-4">Sistem dapat diakses dari berbagai perangkat dengan tampilan yang responsif dan user-friendly.</p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Responsive desktop & mobile</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Interface modern & intuitif</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Performa cepat & stabil</li>
                </ul>
            </div>

        </div>
    </div>
</section>

@endsection