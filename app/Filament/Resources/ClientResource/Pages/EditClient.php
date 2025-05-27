<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (){
                    // Ensure the user_id is set to null before deletion because of soft delete
                    if ($this->record->user_id) {
                        $this->record->user_id = null;
                        $this->record->save();
                    }
                })
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->user) { // Ensure record and user relationship exist
            $data['user_name_display'] = $this->record->user->name;
            $data['user_email_display'] = $this->record->user->email;
            $data['user_role_id_display'] = $this->record->user->role_id; // Populate role_id
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['user_id']) && $user = User::find($data['user_id'])) {
            $updateData = [];
            if (array_key_exists('user_name_display', $data) && $data['user_name_display'] !== $user->name) {
                $updateData['name'] = $data['user_name_display'];
            }
            if (array_key_exists('user_email_display', $data) && $data['user_email_display'] !== $user->email) {
                $updateData['email'] = $data['user_email_display'];
            }
            // Add role_id to updateData if it's provided and different
            if (array_key_exists('user_role_id_display', $data) && $data['user_role_id_display'] !== $user->role_id) {
                $updateData['role_id'] = $data['user_role_id_display'];
            }

            if (!empty($updateData)) {
                $user->update($updateData);
            }
        }

        // Unset display fields so they are not saved on the Client model
        unset($data['user_name_display'], $data['user_email_display'], $data['user_role_id_display']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return ClientResource::getUrl('index');
    }
}
