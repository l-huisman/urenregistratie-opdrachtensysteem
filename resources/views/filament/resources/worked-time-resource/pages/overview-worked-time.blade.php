@use(App\Models\WorkedTime)
@use(Carbon\Carbon)
@use(Carbon\WeekDay)
@use(Illuminate\Support\Collection)

<x-filament-panels::page>

    <div class="flex gap-4 items-center">
        <select wire:model.live.debounce="week"
                class="px-8 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary-500">
            @foreach($this->weekSelectOptions as $option)
                <option wire:key="week-{{ $option }}"  value="{{ $option }}">Week {{ $option }}</option>
            @endforeach
        </select>
        <select wire:model.live.debounce="year"
                class="px-8 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary-500">
            @foreach($this->yearSelectOptions as $option)
                <option wire:key="year-{{ $option }}" value="{{ $option }}" @selected($option == $year)>{{ $option }}</option>
            @endforeach
        </select>

        <button type="button" wire:click="goToCurrentWeek"
                class="px-4 py-2 bg-primary-500 text-white rounded hover:bg-primary-600">
            Now
        </button>
    </div>
    <div>
        <label class="flex items-center gap-2">
            <input type="checkbox" wire:model.live="showWeekendDays"
                   class="border rounded focus:ring-primary-500 focus:ring-2"/>
            Show weekends
        </label>
    </div>

    <x-filament-tables::container>
        <table class="filament-tables-table w-full">
            <thead>
            <tr class="bg-gray-50 font-bold border-b">
                <th class="py-3 text-center">User</th>
                @foreach($this->days as $day)
                    <th wire:key="weekday-{{ $day }}" class="py-3 text-center">
                        {{ $day->shortDayName }}<br>
                        <span class="text-xs text-gray-500">{{ $day->format('d-M') }}</span>
                    </th>
                @endforeach
                <th class="py-3 text-center">Total<br>hours</th>
            </tr>
            </thead>
            <tbody>
            @foreach($this->users as $user)
                <tr class="odd:bg-gray-50">
                    <td class="text-center py-4 border-b">{{ $user->name }}</td>
                    @foreach($this->days as $day)
                        @php
                            $hours = $user->workedTimes
                                ->where(fn (WorkedTime $workedTime) => $workedTime->date->isSameDay($day))
                                ->sum('worked_hours');
                        @endphp
                        <td wire:key="user-{{ $user->id }}-weekday-{{ $day->dayOfWeek }}" class="text-center py-3 border-b">
                            <input
                                name="hours[{{ $user->id }}][{{ $day->toDateString() }}]"
                                value="{{ $hours }}"
                                min="0"
                                step="0.25"
                                class="w-16 px-2 py-1 border rounded text-center focus:outline-none focus:ring-2 focus:ring-primary-500"
                                disabled
                            />
                        </td>
                    @endforeach
                    <td class="text-center py-3 border-b font-bold">{{ $user->workedTimes->sum('worked_hours') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-filament-tables::container>
</x-filament-panels::page>
