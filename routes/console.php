<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('phpeitor:system-info', function () {
    $directory = storage_path('app/phpeitor');
    $path = $directory . DIRECTORY_SEPARATOR . 'system-info.json';

    File::ensureDirectoryExists($directory);

    File::put($path, json_encode([
        'filament' => \Composer\InstalledVersions::getPrettyVersion('filament/filament'),
        'laravel' => app()->version(),
        'php' => PHP_VERSION,
        'generated_at' => now()->format('Y-m-d H:i:s'),
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    $this->info("System info generated at {$path}");
})->purpose('Generate PHPeitor system information for the Filament dashboard');
