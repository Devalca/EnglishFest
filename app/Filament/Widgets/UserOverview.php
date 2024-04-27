<?php

namespace App\Filament\Widgets;

use App\Models\Competition;
use App\Models\Contest;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserOverview extends BaseWidget
{
    protected static ?int $sort = 1;
 
    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::where('is_admin', false)->where('is_rator', false)->count()),
            Card::make('Account Registered Today', User::where('is_admin', false)->where('is_rator', false)->whereDate('created_at', today())->count()),
            Card::make('Registered Competitions', Competition::count()),
        ];
    }
}
