<?php

namespace App\Filament\Customer\Resources\Phase\Pages;

use App\Filament\Customer\Resources\Phase\PhaseResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListPhases extends ListRecords
{
    protected static string $resource = PhaseResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Phase Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
            ]);
    }
}
