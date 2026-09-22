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
        $users = User::count();
        $meetings = Meeting::count();
        $admins = User::where('type', 'admin')->count();
        $activeUsers = User::where('status', 'active')->count();
        $trend = fn (int $total): array => range(0, $total);

        return [
            Stat::make('Usuarios', $users)
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart($trend($users))
                ->color('success'),

            Stat::make('Reuniones', $meetings)
                ->color('primary')
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-calendar-days', IconPosition::Before)
                ->chart($trend($meetings)),

            Stat::make('Admin', $admins)
                ->color('danger')
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-shield-check', IconPosition::Before)
                ->chart($trend($admins)),

            Stat::make('Active', $activeUsers)
                ->color('success')
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart($trend($activeUsers)),
        ];
    }
}
