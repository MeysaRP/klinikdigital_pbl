@props(['title', 'value', 'icon'])

<div class="bg-white p-5 rounded-xl shadow border-l-4 border-primary flex items-center justify-between">
    <div>
        <p class="text-gray-500 text-sm">{{ $title }}</p>
        <h3 class="text-2xl font-bold text-primary">{{ $value }}</h3>
    </div>
    <div class="text-3xl">{{ $icon }}</div>
</div>