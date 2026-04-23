@extends('layouts.dashboard', [
    'pageTitle' => 'Profil Saya',
    'userName' => $profil['nama'],
    'userRole' => 'Pasien',
    'userInitial' => substr($profil['nama'], 0, 2)
])

@section('sidebar')
    <x-sidebar-pasien />
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-3 rounded-xl flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KOLOM KIRI: FOTO & IDENTITAS -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <!-- Avatar -->
                <div class="w-28 h-28 rounded-full bg-[#09637E] flex items-center justify-center text-white text-4xl font-bold shadow-lg border-4 border-[#09637E]/20 mx-auto mb-4">
                    {{ substr($profil['nama'], 0, 2) }}
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $profil['nama'] }}</h2>
                <p class="text-sm text-gray-500 mt-1">Pasien Terdaftar</p>

                <div class="mt-6 pt-6 border-t border-gray-100 text-left space-y-3">
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        <span>{{ $profil['jk'] }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                        <span>{{ $profil['no_hp'] }}</span>
                    </div>
                </div>

                <!-- Tombol Edit -->
                <button onclick="openEditModal()" class="mt-6 w-full bg-[#09637E] text-white hover:bg-[#074d61] font-semibold py-2.5 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Ubah Profil
                </button>
            </div>
        </div>

        <!-- KOLOM KANAN: DETAIL INFO -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 border-b border-gray-100 pb-3">Informasi Pribadi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Nama Lengkap</p>
                        <p class="text-gray-800 font-medium">{{ $profil['nama'] }}</p>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Tanggal Lahir</p>
                        <p class="text-gray-800 font-medium">{{ date('d F Y', strtotime($profil['tgl_lahir'])) }}</p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Jenis Kelamin</p>
                        <p class="text-gray-800 font-medium">{{ $profil['jk'] }}</p>
                    </div>

                    <!-- No HP -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-1">No. HP</p>
                        <p class="text-gray-800 font-medium">{{ $profil['no_hp'] }}</p>
                    </div>

                    <!-- Alamat (Full Width) -->
                    <div class="md:col-span-2">
                        <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Alamat Lengkap</p>
                        <p class="text-gray-800 font-medium">{{ $profil['alamat'] }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ================= POP UP MODAL EDIT PROFIL ================= -->
<div id="editModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center flex">
    <div class="relative w-full max-w-lg max-h-full mx-4">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200">
            <!-- Header -->
            <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-gray-50 rounded-t-2xl">
                <h3 class="text-xl font-bold text-gray-900">Edit Profil</h3>
                <button onclick="closeEditModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Body Form -->
            <form action="{{ route('pasien.profil.update') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $profil['nama'] }}" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ $profil['tgl_lahir'] }}" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jk" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                            <option value="Laki-laki" {{ $profil['jk'] == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $profil['jk'] == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                    <input type="text" name="no_hp" value="{{ $profil['no_hp'] }}" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">{{ $profil['alamat'] }}</textarea>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end pt-4 gap-3 border-t border-gray-100 mt-4">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-[#09637E] rounded-xl hover:bg-[#074d61]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script JS Modal -->
<script>
    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection