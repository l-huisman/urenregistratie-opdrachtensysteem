@php
    use Illuminate\Support\Carbon;
@endphp

<x-filament::page>
    <div class="flex items-center justify-between mb-4">
        <form method="GET" action="" class="flex items-center gap-2">
            <button type="submit" name="week" value="{{ $weekOffset - 1 }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 border border-gray-300 text-gray-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Previous Week
            </button>
            <span class="mx-4 font-semibold text-lg bg-white border border-gray-300 rounded px-4 py-2 shadow-sm">
                {{ Carbon::now()->addWeeks($weekOffset)->subWeek()->startOfWeek()->format('d M Y') }} -
                {{ Carbon::now()->addWeeks($weekOffset)->subWeek()->endOfWeek()->format('d M Y') }}
            </span>
            <button type="submit" name="week" value="{{ $weekOffset + 1 }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 border border-gray-300 text-gray-700 flex items-center">
                Next Week
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </form>
    </div>
    {{ $this->table }}
</x-filament::page>
