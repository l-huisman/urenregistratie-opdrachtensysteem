<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimesheetResource\Pages;
use App\Models\Timesheet;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TimesheetResource extends Resource
{
    protected static ?string $model = Timesheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }


    public static function table(Table $table): Table
    {
        $currentWeek = Carbon::now()->weekOfYear;

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('week_' . ($currentWeek - 3))
                    ->label('Week ' . ($currentWeek - 3)),
                Tables\Columns\TextColumn::make('week_' . ($currentWeek - 2))
                    ->label('Week ' . ($currentWeek - 2)),
                Tables\Columns\TextColumn::make('week_' . ($currentWeek - 1))
                    ->label('Week ' . ($currentWeek - 1)),
                Tables\Columns\TextColumn::make('week_' . $currentWeek)
                    ->label('Week ' . $currentWeek),
            ])
        ->filters([
            // Implement a filter where admins can filter by weeks
        ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimesheets::route('/'),
            'create' => Pages\CreateTimesheet::route('/create'),
            'view' => Pages\ViewTimesheet::route('/{record}'),
            'edit' => Pages\EditTimesheet::route('/{record}/edit'),
        ];
    }
}
