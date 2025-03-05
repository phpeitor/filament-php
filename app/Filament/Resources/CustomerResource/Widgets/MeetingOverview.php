<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Meeting;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class MeetingOverview extends ChartWidget
{
    protected static ?string $heading = 'Reuniones Chart';

    protected static ?int $sort = 1;

    protected static ?int $chartHeight = 100; 

    protected function getData(): array
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3)->startOfDay();
        $data = Meeting::selectRaw("meeting_status, COUNT(*) as aggregate")
        ->where('created_at', '>=', $threeMonthsAgo)
        ->groupByRaw("meeting_status")
        ->orderBy("meeting_status")
        ->get();

        $colors = [
            'requested' => '#FFCE56', 
            'Confirmado' => '#36A2EB', 
            'cancelled' => '#FF6384', 
            'finished' => '#4CAF50', 
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Reuniones',
                    'data' => $data->pluck('aggregate'),
                    'backgroundColor' => $data->pluck('meeting_status')->map(fn($status) => $colors[$status] ?? '#999999'), 
                ],
            ],
            'labels' => $data->pluck('meeting_status'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}