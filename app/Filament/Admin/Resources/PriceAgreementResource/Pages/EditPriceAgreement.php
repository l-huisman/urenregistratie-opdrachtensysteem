<?php

namespace App\Filament\Admin\Resources\PriceAgreementResource\Pages;

use App\Filament\Admin\Resources\PriceAgreementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceAgreement extends EditRecord
{
    protected static string $resource = PriceAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
