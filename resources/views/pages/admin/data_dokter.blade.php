@extends('layouts.dashboard', [
    'pageTitle' => 'Data Dokter',
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
        <h2 class="text-xl font-semibold text-gray-800 uppercase">
            Data Dokter
        </h2>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="bg-white border rounded-lg p-4 flex flex-col md:flex-row justify-between gap-3">

        <!-- SEARCH -->
        <input type="text" placeholder="Cari Dokter..."
            class="border rounded px-3 py-2 text-sm w-full md:w-1/3 focus:ring-2 focus:ring-primary">

        <!-- SHOW DATA -->
        <div class="flex items-center gap-2 text-sm">
            <span>Tampilkan</span>
            <select class="border rounded px-2 py-1">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span>entri</span>
        </div>

    </div>

    <!-- TOMBOL TAMBAH -->
    <div class="flex justify-end">
        <button class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded text-sm">
            + Tambah Dokter
        </button>
    </div>

    <!-- TABEL -->
    <div class="bg-white border rounded-lg overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-center border-collapse">

                <!-- HEADER -->
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">No. STR</th>
                        <th class="p-2 border">No. HP</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="text-gray-700">

                    <tr>
                        <td class="p-2 border">D01</td>
                        <td class="p-2 border">Dr. Sarah</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
                                Aktif
                            </span>
                        </td>
                        <td class="p-2 border">
                            <button class="bg-gray-200 px-3 py-1 rounded text-xs hover:bg-gray-300">
                                Edit
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2 border">D02</td>
                        <td class="p-2 border">Dr. Budi</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
                                Aktif
                            </span>
                        </td>
                        <td class="p-2 border">
                            <button class="bg-gray-200 px-3 py-1 rounded text-xs hover:bg-gray-300">
                                Edit
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2 border">D03</td>
                        <td class="p-2 border">Dr. Rina</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">
                                Nonaktif
                            </span>
                        </td>
                        <td class="p-2 border">
                            <button class="bg-gray-200 px-3 py-1 rounded text-xs hover:bg-gray-300">
                                Edit
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2 border">D04</td>
                        <td class="p-2 border">Dr. Aila</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
                                Aktif
                            </span>
                        </td>
                        <td class="p-2 border">
                            <button class="bg-gray-200 px-3 py-1 rounded text-xs hover:bg-gray-300">
                                Edit
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2 border">D05</td>
                        <td class="p-2 border">Dr. Sutomo</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">
                                Nonaktif
                            </span>
                        </td>
                        <td class="p-2 border">
                            <button class="bg-gray-200 px-3 py-1 rounded text-xs hover:bg-gray-300">
                                Edit
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center p-3 text-sm text-gray-500">

            <span>Menampilkan 1 sampai 5 dari 50 entri</span>

            <div class="flex gap-1">
                <button class="px-2 py-1 border rounded hover:bg-gray-100">1</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">2</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">3</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">4</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">5</button>
            </div>

        </div>

    </div>

</div>

@endsection