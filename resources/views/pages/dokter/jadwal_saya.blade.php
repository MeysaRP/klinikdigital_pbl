@extends('layouts.dashboard', [
    'pageTitle' => 'Jadwal Saya',
    'userName' => 'Dr. Sarah Wijaya',
    'userRole' => 'Dokter',
    'userInitial' => 'DS'
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">

    <!-- CARD INFO -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Total jadwal aktif</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">2</h3>
            <p class="text-xs text-gray-400 mt-1">dari 3 jadwal aktif</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Pasien hari ini</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">12</h3>
            <p class="text-xs text-gray-400 mt-1">dari kuota 20</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Jadwal cuti</p>
            <h3 class="text-lg font-semibold text-gray-800 mt-1">1</h3>
            <p class="text-xs text-gray-400 mt-1">Sabtu, 22 Nov 2025</p>
        </div>

    </div>

    <!-- FILTER -->
    <div class="w-48">
        <select 
             class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm text-gray-700 
               focus:outline-none focus:ring-2 focus:ring-[#09637E] 
               appearance-none bg-white cursor-pointer">

            <option class="py-2">Semua Hari</option>
            <option class="py-2">Senin</option>
            <option class="py-2">Selasa</option>
            <option class="py-2">Rabu</option>
            <option class="py-2">Kamis</option>
            <option class="py-2">Jumat</option>
            <option class="py-2">Sabtu</option>
            <option class="py-2">Minggu</option>

        </select>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm text-left">

            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="px-4 py-3">Hari</th>
                    <th>Waktu</th>
                    <th>Kuota</th>
                    <th>Terisi</th>
                    <th>Status</th>
                    <th class="text-right pr-4">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-gray-700">

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">Senin</td>
                    <td>08.00 - 10.00</td>
                    <td>20</td>
                    <td>12/20</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700 font-semibold">
                            Aktif
                        </span>
                    </td>
                    <td class="text-right pr-4">
                        <button onclick="openModal()" class="text-xs bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200">
                            Lihat pasien
                        </button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">Selasa</td>
                    <td>10.00 - 12.00</td>
                    <td>15</td>
                    <td>5/15</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700 font-semibold">
                            Aktif
                        </span>
                    </td>
                    <td class="text-right pr-4">
                        <button onclick="openModal()" class="text-xs bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200">
                            Lihat pasien
                        </button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">Rabu</td>
                    <td>13.00 - 15.00</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-600 font-semibold">
                            Cuti
                        </span>
                    </td>
                    <td class="text-right pr-4">
                        <button class="text-xs bg-gray-100 px-3 py-1 rounded-lg">
                            Tidak tersedia
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

</div>

<!-- ================= MODAL ================= -->
<div id="modalPasien" class="fixed inset-0 bg-black/30 flex items-center justify-center hidden z-50">

    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-lg border border-gray-100 p-6">

        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Daftar pasien <span class="text-gray-500 text-sm">| 08.00 - 12.00</span>
            </h3>
            <p class="text-sm text-gray-500">Poli Umum: Dr. Sarah Wijaya</p>
            <div class="mt-2 text-xs text-gray-400">
                Senin, 20 November 2025 • 4 Pasien terdaftar
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-100">
            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-3 py-2">No</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th class="text-right pr-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-gray-700">
                    <tr>
                        <td class="px-3 py-2">01</td>
                        <td>Andi Pratama</td>
                        <td>Demam</td>
                        <td><span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Menunggu</span></td>
                        <td class="text-right pr-3"><button class="bg-gray-100 px-3 py-1 rounded-lg text-xs">Periksa</button></td>
                    </tr>

                    <tr>
                        <td class="px-3 py-2">02</td>
                        <td>Siti Aminah</td>
                        <td>Batuk Pilek</td>
                        <td><span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Menunggu</span></td>
                        <td class="text-right pr-3"><button class="bg-gray-100 px-3 py-1 rounded-lg text-xs">Periksa</button></td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal()" class="bg-gray-200 px-4 py-1.5 rounded-lg text-sm hover:bg-gray-300">
                Tutup
            </button>
        </div>

    </div>
</div>

<!-- SCRIPT -->
<script>
function openModal() {
    document.getElementById('modalPasien').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalPasien').classList.add('hidden');
}
</script>

@endsection