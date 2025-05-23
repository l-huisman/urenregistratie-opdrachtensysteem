<?php

namespace App\Filament\Admin\Resources\ContactPersonResource\Pages;

use App\Filament\Admin\Resources\ContactPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactPeople extends ListRecords
{
    protected static string $resource = ContactPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
