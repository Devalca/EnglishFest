<?php

namespace App\Filament\Resources\AcademicPeriodResource\Pages;

use App\Filament\Resources\AcademicPeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcademicPeriod extends EditRecord
{
    protected static string $resource = AcademicPeriodResource::class;

    protected function getHeaderActions(): array
    {
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
