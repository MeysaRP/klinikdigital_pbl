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

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Dokter</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">45</p>
            </div>
            <div class="w-12 h-12 bg-[#09637E]/10 rounded-2xl flex items-center justify-center text-xl">🩺</div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Pasien</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">1.205</p>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-xl">👥</div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Jadwal Hari Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">85</p>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-xl">📅</div>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-base sm:text-lg text-gray-800">Antrian Pasien Hari Ini</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[540px]">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                    <tr>
                        <th class="px-5 py-3.5 text-left">No</th>
                        <th class="px-5 py-3.5 text-left">Nama Pasien</th>
                        <th class="px-5 py-3.5 text-left">Dokter</th>
                        <th class="px-5 py-3.5 text-left">Jam</th>
                        <th class="px-5 py-3.5 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5">01</td>
                        <td class="px-5 py-3.5 font-medium">Andi Pratama</td>
                        <td class="px-5 py-3.5">Dr. Santi Wijaya</td>
                        <td class="px-5 py-3.5">09:30</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5">02</td>
                        <td class="px-5 py-3.5 font-medium">Andi Pratama</td>
                        <td class="px-5 py-3.5">Dr. Santi Wijaya</td>
                        <td class="px-5 py-3.5">09:00</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5">03</td>
                        <td class="px-5 py-3.5 font-medium">Andi Pratama</td>
                        <td class="px-5 py-3.5">Dr. Budi Hartono</td>
                        <td class="px-5 py-3.5">08:00</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">Dilayani</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5">04</td>
                        <td class="px-5 py-3.5 font-medium">Andi Pratama</td>
                        <td class="px-5 py-3.5">Dr. Santi Wijaya</td>
                        <td class="px-5 py-3.5">08:30</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Selesai</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection