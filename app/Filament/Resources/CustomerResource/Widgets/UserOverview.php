<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Meeting;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios', User::count())
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([2,3,5,10,20,40])
                ->color('success'),

            Stat::make('Reuniones', Meeting::count())
                ->color('primary')
                ->description('Total reuniones'),

            Stat::make('Admin', 4)
                ->color('danger')
                ->description('Admin users'),

            Stat::make('Active', 88)
                ->color('success')
                ->description('Active users'),
        ];
    }
}
