<?php

namespace App\Filament\Resources\WorkedTimeResource\Pages;

use App\Filament\Resources\WorkedTimeResource;
use App\Models\User;
use Carbon\CarbonImmutable;
use Carbon\WeekDay;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;


/**
 * @property-read EloquentCollection<int, User> $users
 * @property-read Collection<int, CarbonImmutable> $days
 * @property-read array<int<1, 53>> $weekSelectOptions
 * @property-read int[] $yearSelectOptions
 */
class OverviewWorkedTime extends Page
{
    protected static string $resource = WorkedTimeResource::class;
    protected static string $view = 'filament.resources.worked-time-resource.pages.overview-worked-time';

    #[Url]
    public ?int $week;

    #[Url]
    public ?int $year;

    #[Session]
    public bool $showWeekendDays = false;


    public function mount(Request $request): void
    {
        $this->week ??= Date::today()->week;
        $this->year ??= Date::today()->year;
    }

    public function goToCurrentWeek()
    {
        $today = Date::today();

        $this->week = $today->week;
        $this->year = $today->year;
    }

    #[Computed]
    protected function users()
    {
        return User::query()
            ->with(['workedTimes' => function (HasMany $workedHours) {
                $workedHours
                    ->whereDate('date', '>=', $this->days->first())
                    ->whereDate('date', '<=', $this->days->last());
            }])
            ->get();
    }

    #[Computed]
    protected function days()
    {
        $week = Date::today()
            ->week($this->week)
            ->year($this->year)
            ->toImmutable();

        $firstDayOfWeek = WeekDay::Monday;
        $lastDayOfWeek = $this->showWeekendDays ? WeekDay::Sunday : WeekDay::Friday;

        return collect($week->startOfWeek($firstDayOfWeek)->toPeriod($week->endOfWeek($lastDayOfWeek)));
    }

    #[Computed]
    protected function weekSelectOptions()
    {
        return range(1, 53); // does every year have 53 weeks tho
    }

    #[Computed]
    protected function yearSelectOptions()
    {
        $currentYear = Date::today()->year;

        return range($currentYear - 5, $currentYear + 1);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back to List')
                ->icon('heroicon-m-arrow-uturn-left')
                ->url(fn () => WorkedTimeResource::getUrl()),
        ];
    }
}
