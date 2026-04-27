@extends('layouts.app')

@section('content')

<!-- HERO -->
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

<!-- CONTACT SECTION -->
<section class="bg-gray-50 py-20 border-t border-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">

            <!-- INFO KONTAK -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-[#09637E]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Politeknik Negeri Batam<br>
                        Jl. Politeknik No. 1, Batam Centre<br>
                        Kota Batam, Kepulauan Riau 29461
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-500 text-sm">(0778) 123456</p>
                    <p class="text-gray-500 text-sm">+62 812-3456-7890</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-500 text-sm">info@meditech.batam</p>
                    <p class="text-gray-500 text-sm">support@meditech.batam</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Jam Operasional</h3>
                    <p class="text-gray-500 text-sm">Senin - Jumat: 08:00 - 17:00</p>
                    <p class="text-gray-500 text-sm">Sabtu: 08:00 - 12:00</p>
                    <p class="text-gray-500 text-sm">Minggu: Tutup</p>
                </div>
            </div>

            <!-- FORM KONTAK -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

                    <form class="space-y-5">
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Nama Lengkap</label>
                                <input type="text" placeholder="Masukkan nama lengkap" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Email</label>
                                <input type="email" placeholder="Masukkan email" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. Telepon</label>
                            <input type="tel" placeholder="Masukkan nomor telepon" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Subjek</label>
                            <select class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 bg-white">
                                <option value="">Pilih subjek</option>
                                <option>Informasi Layanan</option>
                                <option>Keluhan Teknis</option>
                                <option>Saran & Masukan</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Pesan</label>
                            <textarea rows="5" placeholder="Tulis pesan Anda..." class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 resize-none"></textarea>
                        </div>

                        <button type="submit" class="bg-[#09637E] hover:bg-[#074d61] text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-md hover:shadow-lg">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection