@props([
        'route' => null,
        'icon' => null,
        'activeClass' => ' text-white bg-indigo-500',
        'inactiveClass' => 'text-white/80',
    ])

@php
    // dd(request()->route()->getName(), $route); // Uncomment to debug
    $isActive = $route && request()->routeIs($route);
    $classes = "flex items-center p-3 rounded-md text-sm font-medium hover:bg-indigo-500 hover:text-white flex items-center justify-start px-4 gap-4 " . ($isActive ? $activeClass : $inactiveClass);
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $route ? route($route) : '#']) }}>
    @if($icon)
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="h-5 w-5"/>
    @endif
    <span>{{ $slot }}</span>
</a>
