@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <h2 class="text-2xl font-bold text-green-900 mb-6">
        Dashboard Pasien
    </h2>

    <!-- Info Cards -->
    <div class="grid grid-cols-3 gap-6">

        <!-- Card Jadwal -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-green-800">Jadwal Saya</h3>
            <p class="text-3xl font-bold mt-2">2</p>
        </div>

        <!-- Card Riwayat -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-green-800">Riwayat Kunjungan</h3>
            <p class="text-3xl font-bold mt-2">5</p>
        </div>

        <!-- Card Booking -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-green-800">Booking Aktif</h3>
            <p class="text-3xl font-bold mt-2">1</p>
        </div>

    </div>

    <!-- Jadwal Terdekat -->
    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-green-800 mb-4">
            Jadwal Terdekat
        </h3>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Tanggal</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-2">10 Mei 2026</td>
                    <td>Dr. Andi</td>
                    <td>Umum</td>
                    <td class="text-green-600">Terjadwal</td>
                </tr>
                <tr>
                    <td class="py-2">12 Mei 2026</td>
                    <td>Dr. Sinta</td>
                    <td>Anak</td>
                    <td class="text-yellow-600">Menunggu</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Riwayat Kunjungan -->
    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-green-800 mb-4">
            Riwayat Kunjungan
        </h3>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Tanggal</th>
                    <th>Dokter</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-2">01 Mei 2026</td>
                    <td>Dr. Andi</td>
                    <td>Flu</td>
                </tr>
                <tr>
                    <td class="py-2">20 April 2026</td>
                    <td>Dr. Sinta</td>
                    <td>Demam</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection