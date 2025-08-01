<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkedTimeResource\Pages;
use App\Models\WorkedTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class WorkedTimeResource extends Resource
{
    protected static ?string $model = WorkedTime::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('phase_id')
                    ->relationship('phase', 'name')
                    ->required(),
                Forms\Components\Select::make('task_id')
                    ->relationship('task', 'name'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('worked_hours')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('billable')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkedTimes::route('/'),
            'create' => Pages\CreateWorkedTime::route('/create'),
            'edit' => Pages\EditWorkedTime::route('/{record}/edit'),
            'overview' => Pages\OverviewWorkedTime::route('/overview'),
        ];
    }
}
