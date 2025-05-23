<?php

namespace App\Filament\Admin\Resources\ContactPersonResource\Pages;

use App\Filament\Admin\Resources\ContactPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactPerson extends EditRecord
{
    protected static string $resource = ContactPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
