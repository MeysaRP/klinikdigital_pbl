@extends('layouts.dashboard_dokter')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- HEADER -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-800">
            Selamat datang, Dr. Sarah Wijaya
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Kelola jadwal, periksa pasien, dan berikan pelayanan terbaik.
        </p>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT CONTENT -->
        <div class="col-span-8 space-y-6">

            <!-- JADWAL -->
            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-semibold text-gray-800 text-lg">Jadwal Praktik</h3>
                </div>

                <div class="overflow-hidden rounded-xl border">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="py-3 px-4 text-left">Waktu</th>
                                <th class="px-4 text-left">Pasien</th>
                                <th class="px-4 text-left">Keluhan</th>
                                <th class="px-4 text-left">Status</th>
                                <th class="px-4 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">09:00</td>
                                <td class="px-4">Budi Santoso</td>
                                <td class="px-4">Demam & Batuk</td>
                                <td class="px-4">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                        Selesai
                                    </span>
                                </td>
                                <td class="px-4 text-right text-blue-500">Lihat</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">10:30</td>
                                <td class="px-4">Ani Lestari</td>
                                <td class="px-4">Sakit Kepala</td>
                                <td class="px-4">
                                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                                        Berlangsung
                                    </span>
                                </td>
                                <td class="px-4 text-right text-blue-500">Lihat</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">13:00</td>
                                <td class="px-4">Citra Dewi</td>
                                <td class="px-4">Nyeri Perut</td>
                                <td class="px-4">
                                    <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs">
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-4 text-right">
                                    <button class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs">
                                        Isi Rekam
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-right mt-4 text-sm text-green-600 cursor-pointer">
                    Lihat semua →
                </div>
            </div>

            <!-- PASIEN -->
            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-semibold text-gray-800 text-lg">Daftar Pasien</h3>

                    <div class="flex gap-2">
                        <input type="text"
                            placeholder="Cari pasien..."
                            class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-green-400 outline-none">

                        <button class="bg-gray-100 hover:bg-gray-200 px-4 rounded-lg text-sm">
                            Filter
                        </button>
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="py-3 px-4 text-left">Nama</th>
                                <th class="px-4 text-left">Usia</th>
                                <th class="px-4 text-left">Keluhan</th>
                                <th class="px-4 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">Budi Santoso</td>
                                <td class="px-4">30</td>
                                <td class="px-4">Demam</td>
                                <td class="px-4 text-right text-blue-500">Detail</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">Ani Lestari</td>
                                <td class="px-4">28</td>
                                <td class="px-4">Sakit Kepala</td>
                                <td class="px-4 text-right text-blue-500">Detail</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-right mt-4 text-sm text-green-600 cursor-pointer">
                    Lihat semua →
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-span-4">
            <div class="bg-white border rounded-2xl p-6 shadow-sm sticky top-6">
                <h3 class="font-semibold text-gray-800 mb-6">Profil</h3>

                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 bg-green-500 text-white flex items-center justify-center rounded-full text-xl font-bold shadow">
                        DS
                    </div>

                    <p class="mt-3 font-semibold text-gray-800">Dr. Sarah Wijaya</p>
                    <p class="text-sm text-gray-500">Spesialis Penyakit Dalam</p>
                </div>

                <div class="text-sm space-y-3 text-gray-600">
                    <p><strong>No. SIP:</strong> SIP.1234/2020</p>
                    <p><strong>No. HP:</strong> 0812-3456-7890</p>
                    <p><strong>Alamat:</strong> Pekanbaru</p>
                </div>

                <button class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                    Edit Profil
                </button>
            </div>
        </div>

    </div>
</div>

@endsection