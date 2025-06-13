<?php

namespace App\Filament\Resources\ContestResource\Pages;

use App\Filament\Resources\ContestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditContest extends EditRecord
{
    protected static string $resource = ContestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Model $record) {
                    if ($record->image && Storage::disk('public')->exists($record->image)) {
                        Storage::disk('public')->delete($record->image);
                    }

                    if ($record->guidelines && Storage::disk('public')->exists($record->guidelines)) {
                        Storage::disk('public')->delete($record->guidelines);
                    }
                })
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->record;

        // Hapus file image lama kalau ada file baru dan berbeda
        if (isset($data['image']) && $record->image && $data['image'] !== $record->image) {
            if (Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
        }

        // Hapus file guidelines lama kalau ada file baru dan berbeda
        if (isset($data['guidelines']) && $record->guidelines && $data['guidelines'] !== $record->guidelines) {
            if (Storage::disk('public')->exists($record->guidelines)) {
                Storage::disk('public')->delete($record->guidelines);
            }
        }

        return $data;
    }
}
