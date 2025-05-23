<?php

namespace App\Filament\Resources\AssignmentLineResource\Pages;

use App\Filament\Resources\AssignmentLineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssignmentLine extends EditRecord
{
    protected static string $resource = AssignmentLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
