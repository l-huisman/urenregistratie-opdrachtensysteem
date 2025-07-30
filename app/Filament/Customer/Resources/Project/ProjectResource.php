<?php

namespace App\Filament\Customer\Resources\Project;


use App\Models\Project;
use Filament\Resources\Resource;

class ProjectResource extends Resource
{
    protected static bool $isScopedToTenant = true;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
        ];
    }
}
