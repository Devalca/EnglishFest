<?php

namespace App\Filament\User\Resources\CompetitionResource\Pages;

use App\Filament\User\Resources\CompetitionResource;
use Filament\Resources\Pages\Page;

class ZeroCompetition extends Page
{
    protected static ?string $title = '404';

    protected static string $resource = CompetitionResource::class;

    protected static string $view = 'filament.user.resources.competition-resource.pages.zero-competition';
}
