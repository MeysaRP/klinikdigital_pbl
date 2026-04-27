@extends('layouts.app')

@section('content')

<!-- HERO ABOUT -->
<section class="bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#09637E]/5 rounded-full filter blur-3xl -z-0 transform translate-x-1/2 -translate-y-1/2"></div>

    <div class="max-w-screen-xl mx-auto px-4 py-16 lg:py-20 relative z-10">
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">

            <!-- Gambar -->
            <div class="relative w-full flex justify-center order-2 lg:order-1">
                <div class="animate-float">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80"
                         class="w-full h-auto max-w-md rounded-2xl shadow-2xl border-4 border-white"
                         alt="Tentang MediTech">
                </div>
            </div>

            <!-- Teks -->
            <div class="text-gray-700 order-1 lg:order-2">
                <p class="text-sm font-semibold text-[#09637E] uppercase tracking-wider mb-3">Tentang Kami</p>
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-tight text-gray-900 md:text-5xl">
                    Mengenal Lebih Dekat<br>
                    <span class="text-[#09637E]">MediTech</span>
                </h1>
                <p class="mb-6 text-lg font-light text-gray-500 leading-relaxed">
                    MediTech adalah sistem manajemen klinik digital yang dikembangkan untuk mempermudah proses pendaftaran pasien, penjadwalan dokter, dan pengelolaan rekam medis secara terintegrasi.
                </p>
                <p class="mb-8 text-gray-500 leading-relaxed">
                    Dibangun oleh mahasiswa Politeknik Negeri Batam sebagai bagian dari Project Based Learning, MediTech bertujuan untuk mendigitalisasi proses administrasi klinik agar lebih efisien, transparan, dan mudah diakses oleh seluruh pihak.
                </p>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-4 text-center">
                        <p class="text-3xl font-bold text-[#09637E]">50+</p>
                        <p class="text-xs text-gray-500 mt-1">Dokter Terdaftar</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4 text-center">
                        <p class="text-3xl font-bold text-[#09637E]">5000+</p>
                        <p class="text-xs text-gray-500 mt-1">Pasien Terlayani</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4 text-center">
                        <p class="text-3xl font-bold text-[#09637E]">3</p>
                        <p class="text-xs text-gray-500 mt-1">Poli Spesialis</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4 text-center">
                        <p class="text-3xl font-bold text-[#09637E]">99%</p>
                        <p class="text-xs text-gray-500 mt-1">Kepuasan Pasien</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- VISI MISI -->
<section class="bg-gray-50 py-20 border-t border-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Visi & Misi</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Landasan kami dalam membangun MediTech.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Visi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="w-14 h-14 bg-[#09637E]/10 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Visi</h3>
                <p class="text-gray-600 leading-relaxed">
                    Menjadi sistem manajemen klinik digital terdepan yang menyediakan layanan kesehatan yang mudah diakses, efisien, dan terpercaya bagi masyarakat.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Misi</h3>
                <ul class="text-gray-600 leading-relaxed space-y-2">
                    <li class="flex items-start gap-2">
                        <span class="text-[#09637E] mt-1">•</span>
                        <span>Mendigitalisasi proses administrasi klinik</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-[#09637E] mt-1">•</span>
                        <span>Mempermudah akses pelayanan kesehatan bagi pasien</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-[#09637E] mt-1">•</span>
                        <span>Meningkatkan efisiensi kerja tenaga medis</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-[#09637E] mt-1">•</span>
                        <span>Menjaga keamanan dan privasi data medis pasien</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- TIM -->
<section class="bg-white py-20 border-t border-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Tim Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Mahasiswa Politeknik Negeri Batam yang mengembangkan MediTech.</p>
        </div>

            <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto">
            <!-- Member 1 -->
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-[#09637E] flex items-center justify-center text-white text-2xl font-bold shadow-lg group-hover:scale-105 transition-transform">
                    JA
                </div>
                <h4 class="font-bold text-gray-900">JELITA AULIA</h4>
                <p class="text-xs text-gray-500 mt-1">3312501021</p>
                <p class="text-xs text-gray-500 mt-1">Full Stack</p>
            </div>
            <!-- Member 2 -->
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-[#09637E] flex items-center justify-center text-white text-2xl font-bold shadow-lg group-hover:scale-105 transition-transform">
                    MY
                </div>
                <h4 class="font-bold text-gray-900">MEYSA RAMELIA PUTRI</h4>
                <p class="text-xs text-gray-500 mt-1">3312501018</p>
                <p class="text-xs text-gray-500 mt-1">Full Stack</p>
            </div>
            <!-- Member 3 -->
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-[#09637E] flex items-center justify-center text-white text-2xl font-bold shadow-lg group-hover:scale-105 transition-transform">
                    CA
                </div>
                <h4 class="font-bold text-gray-900">CITRA ANGGUN BATUBARA</h4>
                <p class="text-xs text-gray-500 mt-1">3312501030</p>
                <p class="text-xs text-gray-500 mt-1">Full Stack</p>
            </div>
        </div>
    </div>
</section>

@endsection