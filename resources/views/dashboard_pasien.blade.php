@extends('layouts.app')

@section('content')
<div class="flex">

    <!-- Sidebar -->
    <div class="w-20 bg-white shadow-md h-screen flex flex-col items-center py-6 gap-6">
        <span>...</span>
        <span>🏠</span>
        <span>📅</span>
        <span>📋</span>
        <span>👤</span>

        <div class="mt-auto">
            <span>🚪</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 grid grid-cols-3 gap-6">

        <!-- LEFT (Jadwal & Resep) -->
        <div class="col-span-2 space-y-6">

            <!-- Jadwal -->
            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="font-semibold text-lg mb-4">Jadwal Booking</h3>

                @for($i = 0; $i < 3; $i++)
                <div class="flex justify-between items-center border p-3 rounded mb-3">
                    <span>📅 Dokter Umum</span>
                    <button class="bg-green-400 text-white px-3 py-1 rounded">Detail</button>
                </div>
                @endfor
            </div>

            <!-- Resep -->
            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="font-semibold text-lg mb-4">Resep Obat</h3>

                @for($i = 0; $i < 3; $i++)
                <div class="flex justify-between items-center border p-3 rounded mb-3">
                    <span>💊 Paracetamol</span>
                    <button class="bg-green-400 text-white px-3 py-1 rounded">Lihat</button>
                </div>
                @endfor
            </div>

        </div>

        <!-- RIGHT (Profile) -->
        <div class="bg-white p-5 rounded-xl shadow">

            <div class="flex flex-col items-center">
                <div class="w-20 h-20 bg-gray-300 rounded-full mb-3"></div>
                <h3 class="font-semibold">Nama Pasien</h3>
                <p class="text-sm text-gray-500">ID: 12345</p>
            </div>

            <div class="mt-6 space-y-3 text-sm">
                <p>👤 Nama: -</p>
                <p>📅 Tanggal Lahir: -</p>
                <p>⚧ Jenis Kelamin: -</p>
                <p>📞 No HP: -</p>
                <p>✉ Email: -</p>
                <p>📍 Alamat: -</p>
            </div>

            <button class="mt-5 w-full bg-green-400 text-white py-2 rounded">
                Edit Profile
            </button>

        </div>

    </div>
</div>
@endsection