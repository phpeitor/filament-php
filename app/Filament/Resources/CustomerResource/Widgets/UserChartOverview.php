<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
//use Flowframe\Trend\Trend;
//use Flowframe\Trend\TrendValue;

class UserChartOverview extends ChartWidget
{
    protected static ?string $heading = 'Usuarios Chart';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = User::selectRaw("MONTH(created_at) as month_number, DATENAME(MONTH, created_at) as month_name, COUNT(*) as aggregate")
        ->whereBetween('created_at', ['2025-01-01 00:00:00.000', '2025-12-31 23:59:59.999'])
        ->groupByRaw("MONTH(created_at), DATENAME(MONTH, created_at)")
        ->orderBy("month_number")
        ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Usuarios',
                    'data' => $data->pluck('aggregate'),
                ],
            ],
            'labels' => $data->pluck('month_name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}