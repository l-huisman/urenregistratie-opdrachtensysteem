<?php

namespace App\Filament\Admin\Resources\PriceAgreementResource\Pages;

use App\Filament\Admin\Resources\PriceAgreementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceAgreements extends ListRecords
{
    protected static string $resource = PriceAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
