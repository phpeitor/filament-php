<?php

namespace App\Filament\Widgets;

use Composer\InstalledVersions;
use Filament\Widgets\Widget;

class SystemInfoWidget extends Widget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.system-info-widget';

    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        return is_file(storage_path('app/phpeitor/system-info.json'));
    }

    protected function getViewData(): array
    {
        $path = storage_path('app/phpeitor/system-info.json');
        $info = [];

        if (is_file($path)) {
            $info = json_decode((string) file_get_contents($path), true) ?: [];
        }

        $items = [
            [
                'label' => 'Filament',
                'value' => $info['filament'] ?? InstalledVersions::getPrettyVersion('filament/filament') ?? 'N/A',
                'icon' => 'bolt',
            ],
            [
                'label' => 'Laravel',
                'value' => $info['laravel'] ?? app()->version(),
                'icon' => 'cube',
            ],
            [
                'label' => 'PHP',
                'value' => $info['php'] ?? PHP_VERSION,
                'icon' => 'code',
            ],
        ];

        return [
            'items' => array_map(fn (array $item): array => [
                ...$item,
                'displayValue' => str_starts_with($item['value'], 'v') ? $item['value'] : "v{$item['value']}",
            ], $items),
            'generatedAt' => $info['generated_at'] ?? null,
        ];
    }
}
