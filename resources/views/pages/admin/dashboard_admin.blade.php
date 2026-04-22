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

    <!-- HEADER -->
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin</h2>
    </div>

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Dokter -->
        <div class="bg-white border rounded-lg p-4 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Dokter</p>
                <h3 class="text-xl font-bold text-gray-800">45</h3>
            </div>
            <div class="text-2xl text-primary">🩺</div>
        </div>

        <!-- Pasien -->
        <div class="bg-white border rounded-lg p-4 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pasien</p>
                <h3 class="text-xl font-bold text-gray-800">1.205</h3>
            </div>
            <div class="text-2xl text-primary">👥</div>
        </div>

        <!-- Jadwal -->
        <div class="bg-white border rounded-lg p-4 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Jadwal Hari Ini</p>
                <h3 class="text-xl font-bold text-gray-800">85</h3>
            </div>
            <div class="text-2xl text-primary">📅</div>
        </div>

    </div>

    <!-- TABEL ANTRIAN -->
    <div class="bg-white border rounded-lg p-5">

        <h3 class="font-semibold mb-4 text-gray-800">Antrian Pasien Hari ini</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama Pasien</th>
                        <th class="p-2 border">Dokter</th>
                        <th class="p-2 border">Jam</th>
                        <th class="p-2 border">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">

                    <tr class="text-center">
                        <td class="p-2 border">01</td>
                        <td class="p-2 border">Andi Pratama</td>
                        <td class="p-2 border">Dr. Santi Wijaya</td>
                        <td class="p-2 border">09:30</td>
                        <td class="p-2 border">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">
                                Menunggu
                            </span>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td class="p-2 border">02</td>
                        <td class="p-2 border">Andi Pratama</td>
                        <td class="p-2 border">Dr. Santi Wijaya</td>
                        <td class="p-2 border">09:00</td>
                        <td class="p-2 border">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">
                                Menunggu
                            </span>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td class="p-2 border">03</td>
                        <td class="p-2 border">Andi Pratama</td>
                        <td class="p-2 border">Dr. Budi Hartono</td>
                        <td class="p-2 border">08:00</td>
                        <td class="p-2 border">
                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs">
                                Dilayani
                            </span>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td class="p-2 border">04</td>
                        <td class="p-2 border">Andi Pratama</td>
                        <td class="p-2 border">Dr. Santi Wijaya</td>
                        <td class="p-2 border">08:30</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
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