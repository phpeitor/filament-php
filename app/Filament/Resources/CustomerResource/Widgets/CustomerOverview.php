<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios', User::count())
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([2,3,5,10,20,40])
                ->color('success'),

            Card::make('Total', 100)
                ->color('primary')
                ->description('Total users'),

            Card::make('Admin', 4)
                ->color('danger')
                ->description('Admin users'),

            Card::make('Active', 88)
                ->color('success')
                ->description('Active users'),
        ];
    }
}
