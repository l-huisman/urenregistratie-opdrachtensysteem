<?php

namespace App\Filament\Customer\Resources\Project\Pages;

use App\Filament\Customer\Resources\Project\ProjectResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Project Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
                TextColumn::make('type')
                    ->label('Project Type')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                ViewAction::make(),
            ]);
    }
}
