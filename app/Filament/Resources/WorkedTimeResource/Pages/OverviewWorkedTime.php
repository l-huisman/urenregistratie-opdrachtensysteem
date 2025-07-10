<?php

namespace App\Filament\Resources\WorkedTimeResource\Pages;

use App\Filament\Resources\WorkedTimeResource;
use App\Models\User;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class OverviewWorkedTime extends Page implements HasTable
{
    protected static string $resource = WorkedTimeResource::class;
    protected static string $view = 'filament.resources.worked-time-resource.pages.overview-worked-time';

    use Tables\Concerns\InteractsWithTable;

    public $startOfWeek;
    public $endOfWeek;

    public int $weekOffset = 0;

    public function mount(Request $request): void
    {
        $this->weekOffset = (int)$request->query('week', 0);
    }

    public function getTableQuery()
    {
        $this->startOfWeek = Carbon::now()->addWeeks($this->weekOffset)->subWeek()->startOfWeek();
        $this->endOfWeek = Carbon::now()->addWeeks($this->weekOffset)->subWeek()->endOfWeek();

        return User::whereHas('workedTimes', function ($query) {
            $query->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);
        })
            ->with(['workedTimes' => function ($query) {
                $query->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);
            }]);
    }

    public function getTableColumns(): array
    {
        $startOfWeek = Carbon::now()->addWeeks($this->weekOffset)->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->addWeeks($this->weekOffset)->subWeek()->endOfWeek();
        $weekdays = collect(range(0, 6))
            ->map(fn ($i) => $startOfWeek->copy()->addDays($i)->format('l'));

        $columns = [
            TextColumn::make('name')->label('User'),
        ];

        foreach ($weekdays as $weekday) {
            $columns[] = TextColumn::make('worked_hours_' . $weekday)
                ->label($weekday)
                // In getTableColumns(), inside getStateUsing:
                ->getStateUsing(function ($record) use ($weekday) {
                    $hours = $record->workedTimes
                        ->filter(function ($item) use ($weekday) {
                            return Carbon::parse($item->date)->format('l') === $weekday;
                        })
                        ->sum('worked_hours');
                    return $hours > 0 ? $hours : '-';
                })
                ->formatStateUsing(function ($state) {
                    if ($state === '-') {
                        return '<span class="inline-block px-2 py-1 border rounded bg-gray-100 text-gray-400">-</span>';
                    }
                    $hours = (float)$state;
                    $color = 'bg-red-200 border-red-400 text-red-800';
                    $tooltip = 'Less than 4 hours';
                    if ($hours >= 8) {
                        $color = 'bg-green-200 border-green-400 text-green-800';
                        $tooltip = '8 or more hours';
                    } elseif ($hours >= 4) {
                        $color = 'bg-yellow-200 border-yellow-400 text-yellow-800';
                        $tooltip = 'Between 4 and 8 hours';
                    }
                    return "<span class=\"inline-block px-2 py-1 border rounded $color\" title=\"$tooltip\">$hours</span>";
                })
                ->html();
        }
        return $columns;
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label('Back to List')
                ->icon('heroicon-m-arrow-uturn-left')
                ->url(fn () => WorkedTimeResource::getUrl('index')),
        ];
    }

    public function previousWeek()
    {
        return redirect()->route(request()->route()->getName(), ['week' => $this->weekOffset - 1]);
    }

    public function nextWeek()
    {
        return redirect()->route(request()->route()->getName(), ['week' => $this->weekOffset + 1]);
    }
}
