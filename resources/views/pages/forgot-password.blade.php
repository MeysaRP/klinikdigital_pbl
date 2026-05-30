@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-gray-100 w-full max-w-md">

        <div class="w-14 h-14 bg-[#09637E]/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-7 h-7 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>

        <h2 class="text-center text-[#09637E] font-bold text-xl mb-2">Lupa Password</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Masukkan email Anda. Link reset password akan dikirim.</p>

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if(session('status'))
            <div class="bg-green-50 border border-green-200 text-green-600 p-3 rounded-xl mb-4 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('forgot.process') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Email</label>
                <input type="email" name="email" placeholder="Masukkan email Anda"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
            </div>

            <button type="submit"
                class="w-full bg-[#09637E] hover:bg-[#074d61] text-white py-2.5 rounded-xl text-sm font-semibold transition">
                Kirim Link Reset Password
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="text-sm text-[#09637E] hover:underline font-medium">
                &larr; Kembali ke Login
            </a>
        </div>

    </div>

</div>

@endsection