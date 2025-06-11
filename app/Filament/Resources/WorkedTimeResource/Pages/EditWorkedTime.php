<?php

namespace App\Filament\Resources\WorkedTimeResource\Pages;

use App\Filament\Resources\WorkedTimeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkedTime extends EditRecord
{
    protected static string $resource = WorkedTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
