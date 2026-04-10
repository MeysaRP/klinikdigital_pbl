@extends('layouts.dashboard_dokter')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-green-900">
            Selamat datang, Dr. Sarah Wijaya
        </h2>
        <p class="text-sm text-gray-600">
            Kelola jadwal, periksa pasien, dan berikan pelayanan terbaik.
        </p>
    </div>

    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT CONTENT -->
        <div class="col-span-2 space-y-6">

            <!-- JADWAL PRAKTIK -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="flex justify-between mb-4">
                    <h3 class="font-semibold">Jadwal Praktik</h3>
                    <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                        + Tambah Jadwal
                    </button>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Waktu</th>
                            <th>Pasien</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td>09:00</td>
                            <td>Budi Santoso</td>
                            <td>Demam & Batuk</td>
                            <td><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Selesai</span></td>
                            <td><button class="text-blue-500">Lihat</button></td>
                        </tr>

                        <tr class="border-b">
                            <td>10:30</td>
                            <td>Ani Lestari</td>
                            <td>Sakit Kepala</td>
                            <td><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Berlangsung</span></td>
                            <td><button class="text-blue-500">Lihat</button></td>
                        </tr>

                        <tr>
                            <td>13:00</td>
                            <td>Citra Dewi</td>
                            <td>Nyeri Perut</td>
                            <td><span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">Menunggu</span></td>
                            <td>
                                <a href="#" class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                    Isi Rekam
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-right text-sm mt-3 text-green-600 cursor-pointer">
                    Lihat semua →
                </p>
            </div>

            <!-- DAFTAR PASIEN -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="flex justify-between mb-4">
                    <h3 class="font-semibold">Daftar Pasien</h3>

                    <div class="flex gap-2">
                        <input type="text" placeholder="Cari pasien..."
                            class="border p-2 rounded text-sm">
                        <button class="bg-gray-200 px-3 rounded text-sm">Filter</button>
                    </div>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Nama</th>
                            <th>Usia</th>
                            <th>Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td>Budi Santoso</td>
                            <td>30</td>
                            <td>Demam</td>
                            <td><button class="text-blue-500">Detail</button></td>
                        </tr>
                        <tr>
                            <td>Ani Lestari</td>
                            <td>28</td>
                            <td>Sakit Kepala</td>
                            <td><button class="text-blue-500">Detail</button></td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-right text-sm mt-3 text-green-600 cursor-pointer">
                    Lihat semua →
                </p>
            </div>

        </div>

        <!-- RIGHT PROFILE -->
        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="font-semibold mb-4">Profil</h3>

            <div class="flex flex-col items-center mb-4">
                <img src="https://ui-avatars.com/api/?name=Dr+Sarah&background=16a34a&color=fff"
                    class="w-20 h-20 rounded-full mb-2">
                <p class="font-semibold">Dr. Sarah Wijaya</p>
                <p class="text-sm text-gray-500">Spesialis Penyakit Dalam</p>
            </div>

            <div class="text-sm space-y-3">
                <p><strong>No. SIP:</strong> SIP.1234/2020</p>
                <p><strong>No. HP:</strong> 0812-3456-7890</p>
                <p><strong>Alamat:</strong> Pekanbaru</p>
            </div>

            <button class="mt-4 w-full bg-green-500 text-white py-2 rounded">
                Edit Profil
            </button>
        </div>

    </div>

</div>

@endsection