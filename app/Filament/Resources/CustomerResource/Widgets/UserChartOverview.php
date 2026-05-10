<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
//use Flowframe\Trend\Trend;
//use Flowframe\Trend\TrendValue;

class UserChartOverview extends ChartWidget
{
    protected ?string $heading = 'Usuarios Chart';

    protected static ?int $sort = 2;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = User::selectRaw("MONTH(created_at) as month_number, DATENAME(MONTH, created_at) as month_name, COUNT(*) as aggregate")
        ->whereYear('created_at', now()->year)
        ->groupByRaw("MONTH(created_at), DATENAME(MONTH, created_at)")
        ->orderBy("month_number")
        ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Usuarios',
                    'data' => $data->pluck('aggregate')->all(),
                ],
            ],
            'labels' => $data->pluck('month_name')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
