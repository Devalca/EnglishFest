<?php

namespace App\Filament\Resources\HomeContentResource\Pages;

use App\Filament\Resources\HomeContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditHomeContent extends EditRecord
{
    protected static string $resource = HomeContentResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['fees']) && is_string($data['fees'])) {
            $data['fees'] = json_decode($data['fees'], true) ?? [];
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->record;

        if (isset($data['hero_image']) && $data['hero_image'] !== $record->hero_image) {
            if ($record->hero_image && Storage::disk('public')->exists($record->hero_image)) {
                Storage::disk('public')->delete($record->hero_image);
            }
        }

        if (isset($data['logo_image']) && $data['logo_image'] !== $record->logo_image) {
            if ($record->logo_image && Storage::disk('public')->exists($record->logo_image)) {
                Storage::disk('public')->delete($record->logo_image);
            }
        }

        return $data;
    }
}
