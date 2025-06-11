<?php

namespace App\Filament\Resources\WorkedTimeResource\Pages;

use App\Filament\Resources\WorkedTimeResource;
use App\Models\WorkedTime;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListWorkedTimes extends ListRecords
{
    protected static string $resource = WorkedTimeResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'billable' => Tab::make('Billable')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('billable', true))
                ->icon('heroicon-m-currency-euro')
                ->badge(WorkedTime::query()->where('billable', true)->count())
                ->badgeColor('success'),
            'non_billable' => Tab::make('Non-billable')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('billable', false))
                ->icon('heroicon-m-x-circle')
                ->badge(WorkedTime::query()->where('billable', false)->count())
                ->badgeColor('danger'),
        ];
    }

    public function getDefaultActiveTab(): string
    {
        return 'all';
    }
}
