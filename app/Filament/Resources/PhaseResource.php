<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhaseResource\Pages;
use App\Filament\Resources\PhaseResource\RelationManagers\TasksRelationManager;
use App\Models\Phase;
use Filament\Resources\Resource;

class PhaseResource extends Resource
{
    protected static ?string $model = Phase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getRelations(): array
    {
        return [
            TasksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhases::route('/'),
            'create' => Pages\CreatePhase::route('/create'),
            'edit' => Pages\EditPhase::route('/{record}/edit'),
        ];
    }
}
