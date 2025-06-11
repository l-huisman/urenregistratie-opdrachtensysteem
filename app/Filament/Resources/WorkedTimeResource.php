<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkedTimeResource\Pages;
use App\Models\WorkedTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phase.name')
                    ->numeric()
                    ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('task.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('worked_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('billable')
                    ->boolean()
                ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
