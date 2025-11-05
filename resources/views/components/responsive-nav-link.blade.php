@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-fuchsia-400 text-start text-base font-bold text-white bg-white/10 focus:outline-none focus:border-fuchsia-400 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:font-bold hover:border-fuchsia-400 hover:bg-white/10 focus:outline-none focus:border-fuchsia-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
