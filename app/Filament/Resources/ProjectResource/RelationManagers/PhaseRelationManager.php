<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Enums\Status;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PhaseRelationManager extends RelationManager
{
    protected static string $relationship = 'phases';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-document-text'),
                Select::make('status')
                    ->options(Status::class)
                    ->default(Status::PLANNED)
                    ->required()
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-information-circle'),
                Textarea::make('description')
                    ->required()
                    ->columnSpan(2),
                DatePicker::make('start_date')
                    ->required()
                    ->default(now())
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-calendar'),
                DatePicker::make('end_date')
                    ->required()
                    ->default(now()->addDays(30))
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-calendar-days'),
                TextInput::make('estimated_hours')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-clock'),
                TextInput::make('actual_hours')
                    ->numeric()
                    ->default(0)
                    ->columnSpan(1)
                    ->prefixIcon('heroicon-o-clock'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('status')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('estimated_hours')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-clock'),
                TextColumn::make('actual_hours')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-clock'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Attach phase')
                    ->multiple()
                    ->forceSearchCaseInsensitive()
                    ->preloadRecordSelect()
                    ->modalHeading('Attach Phases')
                    ->recordSelect(function (Select $select) {
                        /** @var Project $project */
                        $project = $this->getOwnerRecord();

                        return $select
                            ->disableOptionWhen(fn ($value) => in_array($value, $project->phases->modelKeys(), true))
                            ->searchable()
                            ->preload()
                            ->options(Project::query()->pluck('name', 'id'));
                    }),

                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
