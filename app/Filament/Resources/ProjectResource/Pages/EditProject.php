<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Enums\Status;
use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-document-text')
                    ->columnSpan(1),
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required()
                    ->prefixIcon('heroicon-o-building-office')
                    ->columnSpan(1),
                Textarea::make('description')
                    ->required()
                    ->columnSpan(2),
                Select::make('status')
                    ->options(Status::class)
                    ->default(Status::PLANNED)
                    ->required()
                    ->prefixIcon('heroicon-o-information-circle')
                    ->columnSpan(2),
                DatePicker::make('start_date')
                    ->required()
                    ->default(now())
                    ->prefixIcon('heroicon-o-calendar')
                    ->columnSpan(1),
                DatePicker::make('end_date')
                    ->required()
                    ->default(now()->addDays(30))
                    ->prefixIcon('heroicon-o-calendar-days')
                    ->columnSpan(1),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
