@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <h2 class="text-2xl font-bold text-green-900 mb-6">
        Dashboard Admin
    </h2>

    <div class="grid grid-cols-3 gap-6">

        <!-- Card Dokter -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-green-800">Total Dokter</h3>
            <p class="text-3xl font-bold mt-2">10</p>
        </div>

        <!-- Card Pasien -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-green-800">Total Pasien</h3>
            <p class="text-3xl font-bold mt-2">50</p>
        </div>

        <!-- Card Jadwal -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-green-800">Jadwal Hari Ini</h3>
            <p class="text-3xl font-bold mt-2">8</p>
        </div>

    </div>

    <!-- Table -->
    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-green-800 mb-4">
            Data Dokter
        </h3>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Nama</th>
                    <th>Spesialis</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-2">Dr. Andi</td>
                    <td>Umum</td>
                    <td>Aktif</td>
                </tr>
                <tr>
                    <td class="py-2">Dr. Sinta</td>
                    <td>Anak</td>
                    <td>Aktif</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection