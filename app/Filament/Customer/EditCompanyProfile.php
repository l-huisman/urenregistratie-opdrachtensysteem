<?php

namespace App\Filament\Customer;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class EditCompanyProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Company Profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Company Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kvk_number')
                    ->label('KVK Number')
                    ->required()
                    ->numeric()
                    ->maxLength(8),
                TextInput::make('website')
                    ->label('Website')
                    ->placeholder('https://smit.net')
                    ->url()
                    ->maxLength(255),
                TextInput::make('address')
                    ->label('Address')
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('phone_number')
                    ->label('Phone Number')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->label('Company Logo (128kb max)')
                    ->image()
                    ->required()
                    ->maxSize(128) // 512kb
                    ->directory('company-logos')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/svg+xml'])
            ])->columns(2);
    }
}
