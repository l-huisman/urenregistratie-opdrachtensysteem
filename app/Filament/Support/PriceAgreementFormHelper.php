<?php

namespace App\Filament\Support;

use App\Models\Phase;
use App\Models\PriceAgreement;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;

class PriceAgreementFormHelper
{
    public static function getCreateOptionFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('start_date')
                ->default(now())
                ->required(),
            Forms\Components\TextInput::make('budgeted_hours')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('hourly_rate')
                ->numeric()
                ->required(),
            Forms\Components\DatePicker::make('end_date'),
        ];
    }

    public static function getCreateOptionUsing(): callable
    {
        return function (array $data): int {
            return PriceAgreement::create($data)->id;
        };
    }

    public static function getSaveRelationshipsUsing(): callable
    {
        return function (Forms\Components\Select $component, Model $record, array $state) {
            /** @var Phase $phase */
            $phase = $record; // $record is the Phase model instance

            // $state is an array of PriceAgreement IDs (selected or newly created)

            if (!$phase->project) {
                $phase->priceAgreements()->sync($state);
                return;
            }

            $project = $phase->project;

            if (!$project->company) {
                $phase->priceAgreements()->sync($state);
                return;
            }

            $companyId = $project->company->id;

            // Prepare data for sync, including the company_id for the pivot table
            $syncData = collect($state)
                ->mapWithKeys(fn($priceAgreementId) => [$priceAgreementId => ['company_id' => $companyId]])
                ->all();

            $phase->priceAgreements()->sync($syncData);
        };
    }
}
