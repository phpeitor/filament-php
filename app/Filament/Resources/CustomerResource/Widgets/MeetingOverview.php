<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Meeting;
use Filament\Widgets\ChartWidget;

class MeetingOverview extends ChartWidget
{
    protected ?string $heading = 'Reuniones';

    protected static ?int $sort = 1;

    protected ?string $maxHeight = '260px';

    protected function getData(): array
    {
        $data = Meeting::selectRaw('meeting_status, COUNT(*) as aggregate')
            ->groupByRaw('meeting_status')
            ->orderBy('meeting_status')
            ->get();

        $colors = [
            'requested' => '#FFCE56',
            'accepted' => '#36A2EB',
            'cancelled' => '#FF6384',
            'finished' => '#4CAF50',
        ];

        $labels = [
            'requested' => 'Solicitadas',
            'accepted' => 'Aceptadas',
            'cancelled' => 'Canceladas',
            'finished' => 'Finalizadas',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Reuniones',
                    'data' => $data->pluck('aggregate')->all(),
                    'backgroundColor' => $data->pluck('meeting_status')->map(fn ($status) => $colors[$status] ?? '#999999')->all(),
                ],
            ],
            'labels' => $data->pluck('meeting_status')->map(fn ($status) => $labels[$status] ?? $status)->all(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
