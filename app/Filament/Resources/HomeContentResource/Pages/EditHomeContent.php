<?php

namespace App\Filament\Resources\HomeContentResource\Pages;

use App\Filament\Resources\HomeContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeContent extends EditRecord
{
    protected static string $resource = HomeContentResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['fees']) && is_string($data['fees'])) {
            $data['fees'] = json_decode($data['fees'], true) ?? [];
        }
        return $data;
    }
}
