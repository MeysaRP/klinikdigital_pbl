@extends('layouts.dashboard', [
    'pageTitle' => 'Data Jadwal',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
<x-sidebar-admin />
@endsection

@section('content')
<div class="p-6 bg-white rounded shadow">

    <h2 class="text-lg font-semibold mb-4">DATA JADWAL</h2>

    <!-- SEARCH + BUTTON -->
    <div class="flex justify-between mb-4">
        <input type="text" placeholder="Cari Jadwal..."
            class="border px-3 py-1 w-1/3">

        <button onclick="openModal()"
            class="bg-[#09637E] text-white px-4 py-1">
            + Tambah Jadwal
        </button>
    </div>

    <!-- TABLE -->
    <table class="w-full border text-sm">
        <thead class="bg-gray-100 text-center">
            <tr>
                <th class="border px-2 py-1">Dokter</th>
                <th class="border px-2 py-1">Hari</th>
                <th class="border px-2 py-1">Waktu</th>
                <th class="border px-2 py-1">Kuota</th>
                <th class="border px-2 py-1">Status</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($jadwal as $j)
            <tr>  <tr class="text-center align-middle"></td>
                <td class="border px-2 py-1">{{ $j['dokter'] }}</td>
                <td class="border px-2 py-1">{{ $j['hari'] }}</td>
                <td class="border px-2 py-1">{{ $j['waktu'] }}</td>
                <td class="border px-2 py-1">{{ $j['kuota'] }}</td>
                <td class="border px-2 py-1">
                    <span class="px-2 py-1 border">
                        {{ $j['status'] }}
                    </span>
                <td class="border px-2 py-1 text-center space-x-1">

            <!-- EDIT -->
            <button 
                class="bg-[#09637E] text-white px-3 py-1">
                Edit
            </button>
        </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- ================= MODAL ================= -->
<div id="modalJadwal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-[400px] p-6">

        <h2 class="text-center font-semibold mb-4">Tambah Jadwal Praktik</h2>

        <div class="space-y-2 text-sm">

            <div>
                <label>Pilih Dokter</label>
                <select class="w-full border px-2 py-1">
                    <option>Dr. Aditya</option>
                    <option>Dr. Budi</option>
                </select>
            </div>

            <div>
                <label>Hari Praktik</label>
                <select class="w-full border px-2 py-1">
                    <option>Senin</option>
                    <option>Selasa</option>
                </select>
            </div>

            <div class="flex gap-2">
            <div class="w-1/2">
                <label>Jam Mulai</label>
                <select class="w-full border px-2 py-1">
                    <option>08:00</option>
                    <option>09:00</option>
                    <option>10:00</option>
                    <option>11:00</option>
                </select>
            </div>

            <div class="w-1/2">
                <label>Jam Selesai</label>
                <select class="w-full border px-2 py-1">
                    <option>10:00</option>
                    <option>11:00</option>
                    <option>12:00</option>
                </select>
            </div>
        </div>

            <select class="w-full border px-2 py-1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>

            <div>
                <label>Status</label>
                <select class="w-full border px-2 py-1">
                    <option>Aktif</option>
                    <option>Cuti</option>
                </select>
            </div>

        </div>

        <div class="flex justify-center gap-3 mt-4">
            <button onclick="closeModal()" class="border px-4 py-1">Batal</button>
            <button class="bg-[#09637E] text-white px-4 py-1">Simpan</button>
        </div>

    </div>
</div>

<script>
function openModal(){
    document.getElementById('modalJadwal').classList.remove('hidden');
    document.getElementById('modalJadwal').classList.add('flex');
}

function closeModal(){
    document.getElementById('modalJadwal').classList.remove('flex');
    document.getElementById('modalJadwal').classList.add('hidden');
}
</script>

@endsection