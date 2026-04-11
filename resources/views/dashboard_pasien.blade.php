@extends('layouts.dashboard_pasien')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-green-900">
            Selamat datang, Irennesa
        </h2>
        <p class="text-sm text-gray-600">
            Kelola jadwal booking, lihat resep, dan cek profil Anda.
        </p>
    </div>

    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT CONTENT -->
        <div class="col-span-2 space-y-6">

            <!-- JADWAL BOOKING -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="flex justify-between mb-4">
                    <h3 class="font-semibold">Jadwal Booking</h3>
                    <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                        + Booking
                    </button>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Tanggal</th>
                            <th>Dokter</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td>12 Apr 2026</td>
                            <td>Dr. Andi</td>
                            <td>Umum</td>
                            <td>
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                    Selesai
                                </span>
                            </td>
                            <td><button class="text-blue-500">Detail</button></td>
                        </tr>

                        <tr class="border-b">
                            <td>13 Apr 2026</td>
                            <td>Dr. Sinta</td>
                            <td>Gigi</td>
                            <td>
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                    Berlangsung
                                </span>
                            </td>
                            <td><button class="text-blue-500">Detail</button></td>
                        </tr>

                        <tr>
                            <td>14 Apr 2026</td>
                            <td>Dr. Budi</td>
                            <td>Anak</td>
                            <td>
                                <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                                    Menunggu
                                </span>
                            </td>
                            <td>
                                <button class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                    Check-in
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-right text-sm mt-3 text-green-600 cursor-pointer">
                    Lihat semua →
                </p>
            </div>

            <!-- RESEP OBAT -->
            <div class="bg-white p-5 rounded-xl shadow">
                <div class="flex justify-between mb-4">
                    <h3 class="font-semibold">Resep Obat</h3>

                    <div class="flex gap-2">
                        <input type="text" placeholder="Cari obat..."
                            class="border p-2 rounded text-sm">
                        <button class="bg-gray-200 px-3 rounded text-sm">Filter</button>
                    </div>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Nama Obat</th>
                            <th>Dosis</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td>Paracetamol</td>
                            <td>3x sehari</td>
                            <td>Sesudah makan</td>
                            <td><button class="text-blue-500">Lihat</button></td>
                        </tr>
                        <tr>
                            <td>Amoxicillin</td>
                            <td>2x sehari</td>
                            <td>5 hari</td>
                            <td><button class="text-blue-500">Lihat</button></td>
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
                <img src="https://ui-avatars.com/api/?name=Haechan&background=16a34a&color=fff"
                    class="w-20 h-20 rounded-full mb-2">
                <p class="font-semibold">Irennesa</p>
                <p class="text-sm text-gray-500">Pasien</p>
            </div>

            <div class="text-sm space-y-3">
                <p><strong>ID Pasien:</strong> 12345</p>
                <p><strong>No. HP:</strong> 0812-xxxx-xxxx</p>
                <p><strong>Alamat:</strong> Batam</p>
            </div>

            <button class="mt-4 w-full bg-green-500 text-white py-2 rounded">
                Edit Profil
            </button>
        </div>

    </div>

</div>

@endsection