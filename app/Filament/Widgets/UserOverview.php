<?php

namespace App\Filament\Widgets;

use App\Models\Competition;
use App\Models\User;
use App\Models\AcademicPeriod;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getCards(): array
    {
        $academicPeriods = AcademicPeriod::orderBy('year', 'desc')->get();

        $cards = [
            Card::make('Total Users', User::where('is_admin', false)->where('is_rator', false)->count()),
            Card::make('Account Registered Today', User::where('is_admin', false)->where('is_rator', false)->whereDate('created_at', today())->count()),
            Card::make('Total Registered Competitions', Competition::count()),
        ];

        foreach ($academicPeriods as $period) {
            $competitionCount = Competition::whereHas('contest', function ($query) use ($period) {
                $query->where('academic_period_id', $period->id);
            })->count();

            $cards[] = Card::make("Competitions Academic Period ({$period->year})", $competitionCount);
        }

        return $cards;
    }
}
