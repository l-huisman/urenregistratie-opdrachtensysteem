<?php

namespace App\Filament\Customer\Resources\Phase;


use App\Models\Phase;
use Filament\Resources\Resource;

class PhaseResource extends Resource
{
    protected static bool $isScopedToTenant = true;

    protected static ?string $tenantOwnershipRelationshipName = 'project';

    protected static ?string $model = Phase::class;
    protected static ?string $navigationParentItem = 'Projects';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhases::route('/'),
        ];
    }
}
