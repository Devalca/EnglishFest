<?php

namespace App\Filament\User\Resources\CompetitionResource\Pages;

use App\Filament\User\Resources\CompetitionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompetitions extends ListRecords
{
    protected static string $resource = CompetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Daftar Kompetisi'),
        ];
    }
}
