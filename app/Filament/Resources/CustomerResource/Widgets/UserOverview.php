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
        $currentPeriod = [now()->startOfMonth(), now()->endOfMonth()];
        $previousPeriod = [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()];
        $change = function ($query) use ($currentPeriod, $previousPeriod): string {
            $current = (clone $query)->whereBetween('created_at', $currentPeriod)->count();
            $previous = (clone $query)->whereBetween('created_at', $previousPeriod)->count();

            if ($previous === 0) {
                return $current > 0 ? 'Nuevo' : 'Sin cambios';
            }

            $percentage = (int) round((($current - $previous) / $previous) * 100);

            return match (true) {
                $percentage > 0 => "{$percentage}% increase",
                $percentage < 0 => abs($percentage).'% decrease',
                default => 'Sin cambios',
            };
        };

        return [
            Stat::make('Usuarios', $users)
                ->description($change(User::query()))
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart($trend($users))
                ->color('success'),

            Stat::make('Reuniones', $meetings)
                ->color('primary')
                ->description($change(Meeting::query()))
                ->descriptionIcon('heroicon-m-calendar-days', IconPosition::Before)
                ->chart($trend($meetings)),

            Stat::make('Admin', $admins)
                ->color('danger')
                ->description($change(User::where('type', 'admin')))
                ->descriptionIcon('heroicon-m-shield-check', IconPosition::Before)
                ->chart($trend($admins)),

            Stat::make('Active', $activeUsers)
                ->color('success')
                ->description($change(User::where('status', 'active')))
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart($trend($activeUsers)),
        ];
    }
}
