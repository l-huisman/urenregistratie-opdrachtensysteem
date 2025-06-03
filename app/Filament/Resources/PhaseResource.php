<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhaseResource\Pages;
use App\Models\Phase;
use App\Models\PriceAgreement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PhaseResource extends Resource
{
    protected static ?string $model = Phase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Section::make('Price Agreements')
                    ->schema([
                        Forms\Components\Select::make('priceAgreements')
                            ->label('Price Agreements')
                            ->multiple()
                            ->relationship('priceAgreements', 'id') // 'id' or another title attribute from PriceAgreement
                            ->createOptionForm([
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
                            ])
                            ->createOptionUsing(function (array $data): int {
                                // Create the PriceAgreement instance
                                $priceAgreement = PriceAgreement::create($data);
                                // Return its ID
                                return $priceAgreement->id;
                            })
                            ->saveRelationshipsUsing(function (Forms\Components\Select $component, Model $record, array $state) {
                                /** @var \App\Models\Phase $phase */
                                $phase = $record; // $record is the Phase model instance

                                // $state is an array of PriceAgreement IDs (selected or newly created)

                                if (!$phase->project) {
                                    // If Phase has no project, we cannot determine the company.
                                    // Sync without company_id or handle as an error.
                                    // This example will sync without company_id if project is missing.
                                    $phase->priceAgreements()->sync($state);
                                    return;
                                }

                                $project = $phase->project;

                                if (!$project->company) {
                                    // If Project has no company, we cannot determine the company_id.
                                    // Sync without company_id or handle as an error.
                                    $phase->priceAgreements()->sync($state);
                                    return;
                                }

                                $companyId = $project->company->id;

                                // Prepare data for sync, including the company_id for the pivot table
                                $syncData = collect($state)
                                    ->mapWithKeys(fn($priceAgreementId) => [$priceAgreementId => ['company_id' => $companyId]])
                                    ->all();

                                $phase->priceAgreements()->sync($syncData);
                            })
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhases::route('/'),
            'create' => Pages\CreatePhase::route('/create'),
            'edit' => Pages\EditPhase::route('/{record}/edit'),
        ];
    }
}
