@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section id="tentang" class="bg-white relative overflow-hidden">
        <!-- Hiasan Background -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-[#09637E]/5 rounded-full filter blur-3xl -z-0 transform translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-2xl -z-0 transform -translate-x-1/2 translate-y-1/2">
        </div>

        <div class="max-w-screen-xl mx-auto px-4 py-16 lg:py-20 relative z-10">
            <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">

                <!-- Teks Hero -->
                <div class="text-gray-700">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-tight text-gray-900 md:text-5xl">
                        Selamat Datang di<br>
                        <span class="text-[#09637E]">MediTech</span>
                    </h1>
                    <p class="mb-8 text-lg font-light text-gray-500 lg:text-xl">
                        Sistem digitalisasi klinik yang memudahkan pendaftaran pasien, manajemen jadwal dokter, dan akses
                        rekam medis secara cepat dan aman.
                    </p>

                    <!-- CTA -->
                    <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <a href="#layanan"
                            class="inline-flex items-center justify-center gap-2 py-3 px-6 text-base font-semibold text-white rounded-full bg-[#09637E] hover:bg-[#074d61] shadow-[0_10px_25px_-5px_rgba(9,99,126,0.4)] hover:shadow-[0_20px_35px_-5px_rgba(9,99,126,0.5)] transition-all duration-300 transform hover:-translate-y-0.5">
                            Lihat Layanan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gambar Hero -->
                <div class="relative w-full flex justify-center">
                    <div class="animate-float">
                        <img src="{{ asset('images/poltek-batam.jpg') }}"
                            class="w-full h-auto max-w-md rounded-2xl shadow-2xl border-4 border-white"
                            alt="Politeknik Negeri Batam">

                        <div
                            class="absolute -bottom-4 -left-4 bg-white p-4 rounded-xl shadow-lg hidden md:block border border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Terpercaya</p>
                                    <p class="text-xs text-gray-500">Data Aman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- LAYANAN SECTION -->
    <section id="layanan" class="bg-gray-50 py-20 border-t border-gray-100 relative overflow-hidden">
        <!-- Hiasan Background Agar Tidak Kosong -->
        <div class="absolute top-0 left-10 w-72 h-72 bg-[#09637E]/5 rounded-full filter blur-3xl -z-0"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-cyan-100 rounded-full filter blur-3xl -z-0 opacity-40"></div>

        <div class="max-w-screen-xl mx-auto px-4 text-center relative z-10">
            <div class="mb-16">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Layanan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Solusi digital untuk mempermudah pelayanan kesehatan Anda.</p>
            </div>

            <!-- CARD FITUR -->
            <div class="grid gap-10 md:grid-cols-3 px-4">
                <!-- Card 1 -->
                <div
                    class="group flex flex-col items-center bg-white border border-gray-100 rounded-3xl p-8 md:p-10 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div
                        class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-md transform group-hover:scale-110">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900">Pemesanan Jadwal Online</h3>
                    <p class="text-gray-500 text-center leading-relaxed">Daftar antrean dan pilih jadwal dokter dengan mudah
                        tanpa mengantri.</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="group flex flex-col items-center bg-white border border-gray-100 rounded-3xl p-8 md:p-10 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div
                        class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shadow-md transform group-hover:scale-110">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900">Dokter Profesional</h3>
                    <p class="text-gray-500 text-center leading-relaxed">Tenaga medis bersertifikat dan berpengalaman di
                        bidangnya.</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="group flex flex-col items-center bg-white border border-gray-100 rounded-3xl p-8 md:p-10 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_40px_-10px_rgba(9,99,126,0.3)] transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-[#09637E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                    <div
                        class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-100 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 shadow-md transform group-hover:scale-110">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900">Rekam Medis Digital</h3>
                    <p class="text-gray-500 text-center leading-relaxed">Riwayat kesehatan tersimpan rapi, mudah diakses
                        kapan saja.</p>
                </div>
            </div>
        </div>
    </section>
@endsection