<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
