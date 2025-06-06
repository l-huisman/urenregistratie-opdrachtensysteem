<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->prefixIcon('heroicon-o-user')
                    ->label('User'),
                Forms\Components\Select::make('phase_id')
                    ->relationship('phase', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->prefixIcon('heroicon-o-clipboard-document-list')
                    ->label('Phase')
                    ->createOptionForm([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-briefcase')
                            ->label('Project'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-identification')
                            ->label('Phase Name'),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull()
                            // Textarea does not have a prefixIcon, consider if a label icon is sufficient or if a custom view is needed.
                            ->label('Phase Description'),
                    ]),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-identification')
                    ->label('Task Name'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    // Textarea does not have a prefixIcon
                    ->label('Task Description'),
                Forms\Components\TextInput::make('estimated_hours')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefixIcon('heroicon-o-clock')
                    ->label('Task Estimated Hours'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phase.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estimated_hours')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-clock'),
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
