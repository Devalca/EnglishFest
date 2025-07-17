<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.zero-users';

    protected function getHeaderActions(): array
    {
        $cek = $this->record;
        if (auth()->user()->email === "saepul.rahman@nusaputra.ac.id") {
            return [
                Actions\DeleteAction::make(),
                // Actions\DeleteAction::make()
                // ->before(function (DeleteAction $action) {
                //     if ($this->record->user_id != auth()->user()->id) {
                //         Notification::make()
                //             ->danger()
                //             ->title('Anda Siapa???')
                //             ->body('Sepertinya Pendaftaran ini Milik orang lain?')
                //             ->persistent()
                //             ->send();

                //         $action->cancel();
                //     }
                // })
            ];
        } else {
            return [
                
            ];
        }
    }
}
