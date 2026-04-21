@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-white px-4">

    <div class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-2 rounded-2xl shadow-[0_20px_50px_rgba(9,99,126,0.12)] overflow-hidden">

        <!-- LEFT IMAGE -->
        <div class="relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=700&q=85"
                 class="w-full h-full object-cover brightness-90">

            <div class="absolute inset-0 bg-gradient-to-b from-[#09637E]/50 via-[#09637E]/20 to-black/10"></div>

            <div class="absolute top-4 left-4 flex items-center gap-2 z-10">
                <div class="w-7 h-7 bg-white rounded-md flex items-center justify-center">
                    <div class="w-3 h-3 bg-[#09637E] rounded-sm"></div>
                </div>
                <span class="text-white font-semibold text-sm">MediTech</span>
            </div>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-10 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-white text-[11px] font-semibold whitespace-nowrap">
                Terpercaya dan Data Aman
            </div>
        </div>

        <!-- FORM -->
        <div class="bg-white px-5 py-6 md:px-7 md:py-7 flex flex-col justify-center">

            <a href="#" onclick="history.back(); return false;"
               class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600 hover:bg-[#09637E]/10 hover:text-[#09637E] w-fit mb-3 transition">
                ← Kembali
            </a>

            <h1 class="text-lg font-extrabold text-center text-[#09637E] mb-3">
                Daftar Akun
            </h1>

            <form class="flex flex-col gap-2.5">

                <input type="text" placeholder="Username"
                       class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">

                <input type="text" placeholder="Nama lengkap"
                       class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">

                <input type="text" placeholder="Alamat"
                       class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">

                <div class="grid grid-cols-2 gap-2">
                    <input type="date"
                           class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">

                    <input type="tel" placeholder="No HP"
                           class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">
                </div>

                <input type="password" placeholder="Password"
                       class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">

                <input type="password" placeholder="Konfirmasi Password"
                       class="px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/30">

                <button type="submit"
                        class="mt-2 py-2.5 rounded-lg text-sm text-white font-semibold bg-gradient-to-r from-[#09637E] to-[#0b7d9e] hover:opacity-90 transition">
                    Daftar
                </button>

                <p class="text-center text-xs text-gray-400 mt-1">
                    Sudah punya akun?
                    <a href="#" class="text-[#09637E] font-semibold hover:underline">Login</a>
                </p>

            </form>

        </div>

    </div>

</div>

@endsection