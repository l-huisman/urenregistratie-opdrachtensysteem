<?php

namespace App\Filament\Resources\PhaseResource\Pages;

use App\Enums\Status;
use App\Filament\Resources\PhaseResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditPhase extends EditRecord
{
    protected static string $resource = PhaseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-document-text'),
                Select::make('status')
                    ->options(Status::class)
                    ->default(Status::PLANNED)
                    ->required()
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-information-circle'),
                Textarea::make('description')
                    ->required()
                    ->columnSpan(2),
                DatePicker::make('start_date')
                    ->required()
                    ->default(now())
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-calendar'),
                DatePicker::make('end_date')
                    ->required()
                    ->default(now()->addDays(30))
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-calendar-days'),
                TextInput::make('estimated_hours')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-clock'),
                TextInput::make('actual_hours')
                    ->numeric()
                    ->default(0)
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-clock'),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
