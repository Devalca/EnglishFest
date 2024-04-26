<?php

namespace App\Filament\User\Resources\CompetitionResource\Pages;

use App\Filament\User\Resources\CompetitionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCompetition extends CreateRecord
{
    protected static string $resource = CompetitionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = auth()->user()->id;
        $record =  static::getModel()::create($data);

        return $record;
    }
}
