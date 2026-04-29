@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-100 w-full max-w-md">

        <div class="w-14 h-14 bg-[#09637E]/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-7 h-7 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>

        <h2 class="text-center text-[#09637E] font-bold text-xl mb-2">
            Reset Password
        </h2>
        <p class="text-center text-gray-500 text-sm mb-6">
            Masukkan nomor telepon dan password baru Anda.
        </p>

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl mb-4 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 p-3 rounded-xl mb-4 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('forgot.process') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. Telepon</label>
                <input type="text" name="no_hp"
                    placeholder="Masukkan No Telepon"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
            </div>

            <div>
                <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Password Baru</label>
                <input type="password" name="password"
                    placeholder="Masukkan password baru"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
            </div>

            <button type="submit"
                class="w-full bg-[#09637E] hover:bg-[#074d61] text-white py-2.5 rounded-xl text-sm font-semibold transition">
                Reset Password
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="text-sm text-[#09637E] hover:underline font-medium">
                ← Kembali ke Login
            </a>
        </div>

    </div>

</div>

@endsection