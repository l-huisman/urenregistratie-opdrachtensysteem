<?php

namespace App\Filament\Resources\WorkedTimeResource\Pages;

use App\Filament\Resources\WorkedTimeResource;
use App\Models\WorkedTime;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListWorkedTimes extends ListRecords
{
    protected static string $resource = WorkedTimeResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phase.project.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phase.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('task.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('worked_hours')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('billable')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('user')
                    ->form([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->placeholder('Select User'),
                    ])
                    ->query(fn (Builder $query, array $data) => isset($data['user_id']) ? $query->where('user_id', $data['user_id']) : $query),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('overview')
                ->label('Overview')
                ->icon('heroicon-m-chart-bar')
                ->url(fn () => WorkedTimeResource::getUrl('overview')),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->icon('heroicon-m-chart-bar')
                ->badge(WorkedTime::query()->count())
                ->badgeColor('primary'),
            'billable' => Tab::make('Billable')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('billable', true))
                ->icon('heroicon-m-currency-euro')
                ->badge(WorkedTime::query()->where('billable', true)->count())
                ->badgeColor('success'),
            'non_billable' => Tab::make('Non-billable')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('billable', false))
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
