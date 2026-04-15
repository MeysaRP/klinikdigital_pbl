@extends('layouts.dashboard_pasien')

@section('content')

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Selamat datang, Andi Pratama Rayhan!
        </h2>
        <p class="text-sm text-gray-500">
            Kelola kesehatan Anda dengan mudah
        </p>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="col-span-2 space-y-6">

            <!-- PEMESANAN -->
            <div class="bg-white border rounded-xl p-5">
                <h3 class="font-semibold text-gray-800 mb-4">
                    Pemesanan Jadwal
                </h3>

                <div class="space-y-3 text-sm">

                    <div class="border p-3 rounded flex justify-between items-center">
                        <div>
                            <p class="font-semibold">22 Mei 2025</p>
                            <p class="text-gray-500">Dr. Sarah Wijaya</p>
                        </div>
                        <span class="bg-gray-200 px-3 py-1 rounded text-xs">Menunggu</span>
                        <button class="bg-black text-white px-3 py-1 rounded text-xs">
                            Lihat
                        </button>
                    </div>

                    <div class="border p-3 rounded flex justify-between items-center">
                        <div>
                            <p class="font-semibold">15 Januari 2024</p>
                            <p class="text-gray-500">Dr. Budi Hartono</p>
                        </div>
                        <span class="bg-green-200 px-3 py-1 rounded text-xs">Selesai</span>
                        <button class="bg-black text-white px-3 py-1 rounded text-xs">
                            Lihat
                        </button>
                    </div>

                </div>
            </div>

            <!-- RIWAYAT -->
            <div class="bg-white border rounded-xl p-5">
                <h3 class="font-semibold text-gray-800 mb-4">
                    Riwayat Pemeriksaan
                </h3>

                <div class="space-y-3 text-sm">

                    <div class="border p-3 rounded flex justify-between">
                        <span>Demam dan Batuk</span>
                        <button class="bg-black text-white px-3 py-1 rounded text-xs">
                            Detail
                        </button>
                    </div>

                    <div class="border p-3 rounded flex justify-between">
                        <span>Sakit Kepala</span>
                        <button class="bg-black text-white px-3 py-1 rounded text-xs">
                            Detail
                        </button>
                    </div>

                    <div class="border p-3 rounded flex justify-between">
                        <span>Nyeri Perut</span>
                        <button class="bg-black text-white px-3 py-1 rounded text-xs">
                            Detail
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <div class="bg-white border rounded-xl p-6">

            <h3 class="font-semibold text-gray-800 mb-6">
                Profil
            </h3>

            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-green-500 text-white flex items-center justify-center rounded-full text-xl font-bold shadow">
                    AR
                </div>
            </div>

            <!-- DATA -->
            <div class="text-sm space-y-3 text-gray-700">
                <p><span class="font-semibold">Nama:</span> Andi Pratama Rayhan</p>
                <p><span class="font-semibold">Tanggal Lahir:</span> 15 Maret 2001</p>
                <p><span class="font-semibold">Umur:</span> 23 Tahun</p>
                <p><span class="font-semibold">Jenis Kelamin:</span> Laki-laki</p>
                <p><span class="font-semibold">No HP:</span> 0812-3456-7890</p>
                <p><span class="font-semibold">Alamat:</span> Pekanbaru</p>
            </div>

            <button class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded text-sm shadow-sm hover:shadow-md">
                Ubah Profil
            </button>

        </div>

    </div>

</div>

@endsection