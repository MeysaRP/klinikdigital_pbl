@extends('layouts.dashboard', [
    'pageTitle' => 'Profil Admin',
    'userName' => $userName,
    'userRole' => $userRole,
    'userInitial' => $userInitial
])

@section('sidebar')
    <x-sidebar-admin />
@endsection

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">Profil Admin</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola informasi akun admin Anda.</p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 text-sm">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-lg text-gray-800 mb-5 flex items-center gap-2">
            <svg class="w-5 h-5 text-[#09637E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Informasi Akun
        </h3>

        <form action="{{ route('admin.profil.update') }}" method="POST">
            @csrf

            <!-- Avatar -->
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                <div class="w-20 h-20 rounded-full bg-[#09637E] flex items-center justify-center text-white text-2xl font-bold shadow-lg border-4 border-[#09637E]/10">
                    {{ $userInitial }}
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-lg">{{ $user->name }}</p>
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-[#09637E]/10 text-[#09637E]">Admin</span>
                </div>
            </div>

            <div class="space-y-5 max-w-md">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] focus:border-[#09637E]" required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] focus:border-[#09637E]" required>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <input type="text" value="Admin" disabled class="w-full border border-gray-200 rounded-xl p-3 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                </div>
            </div>

            <button type="submit" class="mt-6 bg-[#09637E] hover:bg-[#074d61] text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm">
                Simpan Perubahan
            </button>
        </form>
    </div>

</div>
@endsection