<?php

namespace App\Filament\Resources\PhaseResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->prefixIcon('heroicon-o-user')
                    ->label('Responsible User')
                    ->searchable()
                    ->columnSpan(2),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-identification')
                    ->label('Task Name')
                    ->columnSpan(1),
                Select::make('phase_id')
                    ->relationship('phase', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->prefixIcon('heroicon-o-clipboard-document-list')
                    ->label('Phase')
                    ->createOptionForm([
                        Select::make('project_id')
                            ->relationship('project', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-briefcase')
                            ->label('Project'),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-identification')
                            ->label('Phase Name'),
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->label('Phase Description'),
                    ])
                    ->columnSpan(1),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Task Description')
                    ->columnSpan(2),
                TextInput::make('estimated_hours')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefixIcon('heroicon-o-clock')
                    ->label('Task Estimated Hours')
                    ->columnSpan(1),
                TextInput::make('actual_hours')
                    ->numeric()
                    ->disabled()
                    ->prefixIcon('heroicon-o-clock')
                    ->label('Task Actual Hours')
                    ->columnSpan(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phase.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('estimated_hours')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-clock'),
                TextColumn::make('actual_hours')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-clock'),
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

            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
