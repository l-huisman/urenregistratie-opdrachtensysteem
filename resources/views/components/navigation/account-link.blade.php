@props([
        'route' => null,
        'icon' => null,
        'activeClass' => ' text-white',
        'inactiveClass' => 'text-white/80',
    ])

    @php
        $isActive = $route ? request()->routeIs($route) : false;
        $baseTextColorClass = $isActive ? $activeClass : $inactiveClass;

        $containerClasses = "group flex items-center justify-between w-full p-3 rounded-md text-sm font-medium hover:bg-indigo-500";
    @endphp

    <div {{ $attributes->merge(['class' => $containerClasses]) }}>
        <a href="{{ $route ? route($route) : '#' }}" class="flex items-center gap-4 flex-grow {{ $baseTextColorClass }} group-hover:text-white">
            @if($icon)
                <x-dynamic-component :component="'heroicon-o-' . $icon" class="h-5 w-5"/>
            @endif
            <span>{{ $slot }}</span>
        </a>
        <form method="POST" action="{{ url('/logout') }}" class="ml-2 shrink-0">
            @csrf
            @method('DELETE')
            <button type="submit" class="{{ $baseTextColorClass }} group-hover:text-white focus:outline-none p-1 rounded-md hover:bg-indigo-700/50 bg-transparent border-none"
                    aria-label="Log out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
            </button>
        </form>
    </div>
