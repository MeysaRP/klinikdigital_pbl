@extends('layouts.dashboard', [
    'pageTitle' => 'Dashboard Admin',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
    <x-sidebar-admin />
@endsection

@section('content')
<div class="space-y-6">

    <!-- HEADER DIHAPUS (biar gak dobel) -->

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Dokter -->
        <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm">
            <div>
                <p class="text-sm text-gray-500">Total Dokter</p>
                <h3 class="text-xl font-bold text-gray-800">45</h3>
            </div>
            <div class="text-2xl text-primary">🩺</div>
        </div>

        <!-- Pasien -->
        <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm">
            <div>
                <p class="text-sm text-gray-500">Total Pasien</p>
                <h3 class="text-xl font-bold text-gray-800">1.205</h3>
            </div>
            <div class="text-2xl text-primary">👥</div>
        </div>

        <!-- Jadwal -->
        <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm">
            <div>
                <p class="text-sm text-gray-500">Total Jadwal Hari Ini</p>
                <h3 class="text-xl font-bold text-gray-800">85</h3>
            </div>
            <div class="text-2xl text-primary">📅</div>
        </div>

    </div>

    <!-- TABEL ANTRIAN -->
    <div class="bg-white rounded-lg p-5 shadow-sm">

        <h3 class="font-semibold mb-4 text-gray-800">Antrian Pasien Hari ini</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left font-medium">No</th>
                        <th class="p-3 text-left font-medium">Nama Pasien</th>
                        <th class="p-3 text-left font-medium">Dokter</th>
                        <th class="p-3 text-left font-medium">Jam</th>
                        <th class="p-3 text-left font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">

                    <tr class="hover:bg-gray-50">
                        <td class="p-3">01</td>
                        <td class="p-3">Andi Pratama</td>
                        <td class="p-3">Dr. Santi Wijaya</td>
                        <td class="p-3">09:30</td>
                        <td class="p-3">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs font-medium">
                                Menunggu
                            </span>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="p-3">02</td>
                        <td class="p-3">Andi Pratama</td>
                        <td class="p-3">Dr. Santi Wijaya</td>
                        <td class="p-3">09:00</td>
                        <td class="p-3">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs font-medium">
                                Menunggu
                            </span>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="p-3">03</td>
                        <td class="p-3">Andi Pratama</td>
                        <td class="p-3">Dr. Budi Hartono</td>
                        <td class="p-3">08:00</td>
                        <td class="p-3">
                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs font-medium">
                                Dilayani
                            </span>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="p-3">04</td>
                        <td class="p-3">Andi Pratama</td>
                        <td class="p-3">Dr. Santi Wijaya</td>
                        <td class="p-3">08:30</td>
                        <td class="p-3">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-medium">
                                Selesai
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection