<?php

namespace App\Filament\User\Resources\CompetitionResource\Pages;

use App\Filament\User\Resources\CompetitionResource;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCompetition extends EditRecord
{
    protected static string $resource = CompetitionResource::class;

    protected static string $view = 'filament.user.resources.competition-resource.pages.zero-competition';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (DeleteAction $action) {
                    if ($this->record->user_id != auth()->user()->id) {
                        Notification::make()
                            ->danger()
                            ->title('Anda Siapa???')
                            ->body('Sepertinya Pendaftaran ini Milik orang lain?')
                            ->persistent()
                            ->send();

                        $action->cancel();
                    }
                })
        ];
    }
}
