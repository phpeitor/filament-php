<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.end',
            fn (): string => request()->routeIs('filament.phpeitor.auth.login')
                ? Blade::render('@vite(\'resources/css/custom-login.css\')')
                : '',
        );
       
    }
}
