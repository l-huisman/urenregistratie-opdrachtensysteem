<?php

namespace App\Filament\Resources\AssignmentLineResource\Pages;

use App\Filament\Resources\AssignmentLineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssignmentLines extends ListRecords
{
    protected static string $resource = AssignmentLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
