@props(['title', 'value' => 0, 'color' => 'blue'])

@php
    $colors = [
        'blue' => 'bg-blue-50 border-blue-200 text-blue-700',
        'green' => 'bg-green-50 border-green-200 text-green-700',
        'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
        'red' => 'bg-red-50 border-red-200 text-red-700',
        'indigo' => 'bg-indigo-50 border-indigo-200 text-indigo-700',
    ];
@endphp

<div
    class="p-4 border {{ $colors[$color] ?? 'bg-gray-50 border-gray-200 text-gray-700' }} rounded-lg text-center shadow-sm">
    <p class="text-sm text-gray-600">{{ $title }}</p>
    <p class="text-3xl font-bold">{{ $value }}</p>
</div>
