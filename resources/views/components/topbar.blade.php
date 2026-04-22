@props(['name' => 'User', 'role' => 'Role', 'initial' => 'U', 'pageTitle' => 'Dashboard'])

<header class="sticky top-0 z-30 bg-white border-b border-gray-200">
    <div class="px-6 py-3 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">{{ $pageTitle }}</h2>
        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-gray-900">{{ $name }}</p>
                <p class="text-xs text-gray-500">{{ $role }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-[#09637E] flex items-center justify-center text-white font-bold shadow-md border-2 border-white">
                {{ $initial }}
            </div>
        </div>
    </div>
</header>

