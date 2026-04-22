<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-4 bg-white border-r border-gray-200">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white">
        <a href="/" class="flex items-center pl-2.5 mb-8">
            <svg class="w-8 h-8 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z" />
                <path
                    d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                <path fill-rule="evenodd"
                    d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z"
                    clip-rule="evenodd" />
            </svg>
            <span class="self-center text-xl font-bold whitespace-nowrap text-[#09637E] ml-2">MediTech</span>
        </a>
        <ul class="space-y-2">
            <li><a href="#"
                    class="flex items-center p-3 text-base font-semibold text-white bg-[#09637E] rounded-xl group"><svg
                        class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg> Dashboard</a></li>
            <li><a href="#"
                    class="flex items-center p-3 text-base font-medium text-gray-700 rounded-xl hover:bg-gray-100 group"><svg
                        class="w-5 h-5 mr-3 text-gray-400 group-hover:text-[#09637E]" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg> Pemesanan Jadwal</a></li>
            <li><a href="#"
                    class="flex items-center p-3 text-base font-medium text-gray-700 rounded-xl hover:bg-gray-100 group"><svg
                        class="w-5 h-5 mr-3 text-gray-400 group-hover:text-[#09637E]" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                            clip-rule="evenodd"></path>
                    </svg> Riwayat pemeriksaan</a></li>
            <li><a href="#"
                    class="flex items-center p-3 text-base font-medium text-gray-700 rounded-xl hover:bg-gray-100 group"><svg
                        class="w-5 h-5 mr-3 text-gray-400 group-hover:text-[#09637E]" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg> Profil</a></li>
        </ul>
    </div>
    <div class="absolute bottom-0 left-0 justify-center p-4 w-full border-t border-gray-200 bg-white">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full p-3 text-base font-medium text-red-600 rounded-xl hover:bg-red-50 group"><svg
                    class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg> Logout</button>
        </form>
    </div>
</aside>