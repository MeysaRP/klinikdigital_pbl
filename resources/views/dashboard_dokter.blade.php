@extends('layouts.dashboard_dokter')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white p-5 rounded-xl shadow">
        <p>Booking Hari Ini</p>
        <h2 class="text-2xl font-bold">7</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p>Jadwal Praktik</p>
        <h2 class="text-2xl font-bold">5</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p>Total Pasien</p>
        <h2 class="text-2xl font-bold">15</h2>
    </div>

</div>

<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-lg font-semibold text-green-800 mb-4">
        Jadwal Hari Ini
    </h3>

    <table class="w-full text-left">
        <thead>
            <tr class="border-b">
                <th class="py-2">Nama Pasien</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="py-2">Ahmad Faisal</td>
                <td>10:00</td>
                <td>
                    <a href="#" class="bg-green-400 text-white px-3 py-1 rounded">
                        Isi Rekam Medis
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection