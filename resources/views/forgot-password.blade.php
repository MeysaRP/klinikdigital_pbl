@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-light">

    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-md">

        <h2 class="text-center text-primary font-bold text-xl mb-4">
            Reset Password
        </h2>

        <!-- ERROR -->
        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="bg-green-100 text-green-600 p-2 rounded mb-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('forgot.process') }}" class="space-y-4">
            @csrf

            <!-- NO HP -->
            <input type="text" name="no_hp"
                placeholder="Masukkan No Telepon"
                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary">

            <!-- PASSWORD BARU -->
            <input type="password" name="password"
                placeholder="Password Baru"
                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-primary">

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded hover:bg-secondary">
                Reset Password
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="/login" class="text-sm text-primary hover:underline">
                Kembali ke Login
            </a>
        </div>

    </div>

</div>

@endsection