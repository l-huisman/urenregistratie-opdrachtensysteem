<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Associated User')
                    ->description('Select an existing user or create a new one.')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('User (Client)')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Client Name'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Client Email')
                                    ->unique(table: User::class, column: 'email', ignoreRecord: true),
                                TextInput::make('password')
                                    ->password()
                                    ->required()
                                    ->minLength(8)
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->helperText('Create a password for the new user.'),
                                Forms\Components\Select::make('role_id')
                                    ->relationship('role', 'name')
                                    ->options(Role::pluck('name', 'id'))
                                    ->label('Role')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                            ])
                            ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                                return $action
                                    ->modalHeading('Create User (Client)')
                                    ->modalButton('Create User');
                            })
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state && $user = User::find($state)) {
                                    $set('user_name_display', $user->name);
                                    $set('user_email_display', $user->email);
                                    $set('user_role_id_display', $user->role_id);
                                } else {
                                    $set('user_name_display', null);
                                    $set('user_email_display', null);
                                    $set('user_role_id_display', null);
                                }
                            }),
                    ]),
                TextInput::make('user_name_display')
                    ->label('User Name')
                    ->required(fn(Forms\Get $get) => filled($get('user_id')))
                    ->disabled(fn(Forms\Get $get) => !$get('user_id'))
                    ->maxLength(255),
                TextInput::make('user_email_display')
                    ->label('User Email')
                    ->email()
                    ->required(fn(Forms\Get $get) => filled($get('user_id')))
                    ->disabled(fn(Forms\Get $get) => !$get('user_id'))
                    ->maxLength(255)
                    ->unique(
                        table: User::class,
                        column: 'email',
                        ignorable: fn(Forms\Get $get) => $get('user_id') ? User::find($get('user_id')) : null
                    ),
                Forms\Components\Select::make('user_role_id_display')
                    ->label('User Role')
                    ->options(Role::pluck('name', 'id'))
                    ->required(fn(Forms\Get $get) => filled($get('user_id')))
                    ->disabled(fn(Forms\Get $get) => !$get('user_id'))
                    ->searchable()
                    ->preload(),
                PhoneInput::make('phone_number')
                    ->defaultCountry('NL'),
                Forms\Components\Select::make('companies')
                    ->multiple()
                    ->relationship('companies', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Company Name')
                            ->unique(table: Company::class, column: 'name', ignoreRecord: true),
                    ])
                    ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                        return $action
                            ->modalHeading('Create Company')
                            ->modalButton('Create Company');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->with(['companies', 'user.role']);
            })
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.role.name')
                    ->label('User Role')
                    ->searchable(),
                PhoneColumn::make('phone_number')
                    ->displayFormat(PhoneInputNumberType::NATIONAL)
                    ->countryColumn('phone_country'),
                Tables\Columns\TextColumn::make('companies')
                    ->label('Companies')
                    ->formatStateUsing(fn($record) => $record->companies->pluck('name')->join(', ')),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
