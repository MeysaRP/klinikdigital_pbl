@extends('layouts.app')

@section('content')

<section class="bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#09637E]/5 rounded-full filter blur-3xl -z-0 transform translate-x-1/2 -translate-y-1/2"></div>

    <div class="max-w-screen-xl mx-auto px-4 py-16 lg:py-20 relative z-10 text-center">
        <p class="text-sm font-semibold text-[#09637E] uppercase tracking-wider mb-3">Hubungi Kami</p>
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-tight text-gray-900 md:text-5xl">
            Ada Pertanyaan?<br>
            <span class="text-[#09637E]">Kami Siap Membantu</span>
        </h1>
        <p class="text-lg font-light text-gray-500 max-w-2xl mx-auto">
            Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan seputar layanan MediTech.
        </p>
    </div>
</section>

<!-- Info Kontak Cards -->
<section class="bg-gray-50 py-20 border-t border-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Alamat -->
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:border-[#09637E]/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-[#09637E]/10 group-hover:bg-[#09637E]/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                    <svg class="w-6 h-6 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Alamat</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Jl. Ahmad Yani, Tlk. Tering,<br>Kec. Batam Kota,<br>Kota Batam, Kepulauan Riau 29461</p>
            </div>

            <!-- Telepon -->
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:border-[#09637E]/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-green-50 group-hover:bg-green-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Telepon</h3>
                <p class="text-gray-500 text-sm">(0778) 123456</p>
                <p class="text-gray-500 text-sm">+62 812-3456-7890</p>
            </div>

            <!-- Email -->
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:border-[#09637E]/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-50 group-hover:bg-blue-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-500 text-sm">info@meditech.batam</p>
                <p class="text-gray-500 text-sm">support@meditech.batam</p>
            </div>

            <!-- Jam Operasional -->
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:border-[#09637E]/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 bg-amber-50 group-hover:bg-amber-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Jam Operasional</h3>
                <div class="text-sm text-gray-500 space-y-1.5">
                    <div class="flex justify-between"><span>Senin - Jumat</span><span class="font-medium text-gray-700">08:00 - 17:00</span></div>
                    <div class="flex justify-between"><span>Sabtu</span><span class="font-medium text-gray-700">08:00 - 12:00</span></div>
                    <div class="flex justify-between"><span>Minggu</span><span class="font-medium text-red-500">Tutup</span></div>
                </div>
            </div>
        </div>

        <!-- Galeri Gambar -->
        <div class="grid lg:grid-cols-2 gap-8 items-stretch">
            <!-- Gambar Besar (POLITEKNIK NEGERI BATAM) -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                <img
    src="{{ asset('images/poltek-batam.jpg') }}"
    alt="Politeknik Negeri Batam"
    class="w-full h-full min-h-[350px] object-cover group-hover:scale-105 transition-transform duration-700"
>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-2xl font-bold text-white mb-2">Politeknik Negeri Batam</h3>
                    <p class="text-gray-200 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota
                    </p>
                </div>
            </div>

            <!-- 2 Gambar Kecil -->
            <div class="grid grid-rows-2 gap-4">
                <!-- Gambar Ruang Tunggu -->
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <img
                        src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=700&h=280&fit=crop&crop=center"
                        alt="Ruang Tunggu"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-4 left-5">
                        <span class="bg-white/20 backdrop-blur-md text-white text-xs font-medium px-3 py-1.5 rounded-full">Ruang Tunggu</span>
                    </div>
                </div>
                <!-- Gambar Peralatan Modern -->
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <img
                        src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=700&h=280&fit=crop&crop=center"
                        alt="Peralatan medis"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-4 left-5">
                        <span class="bg-white/20 backdrop-blur-md text-white text-xs font-medium px-3 py-1.5 rounded-full">Peralatan Modern</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection