<?php

namespace App\Providers\Filament;

use App\Filament\Resources\CustomerResource\Widgets\CustomerOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\Enums\ThemeMode;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Contracts\View\View;
use Rmsramos\SystemInfo\SystemInfoPlugin;
use Stephenjude\FilamentDebugger\DebuggerPlugin;

class PhpeitorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarFullyCollapsibleOnDesktop()
            ->default()
            ->profile()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->brandName(name: 'PHPeitor')
            ->defaultThemeMode(ThemeMode::Dark)
            ->brandLogo(fn(): View => view('filament.logo'))
            ->brandLogoHeight(fn() => auth()->check() ? '1.6rem' : '2rem')
            ->favicon(asset('images/favicon-32x32.png'))
            ->id('phpeitor')
            ->path('phpeitor')
            ->login()
            ->darkMode(true)
            ->renderHook(
                'panels::body.end',
                fn (): View => view('filament.footer')
            )
            ->viteTheme('resources/css/filament/phpeitor/theme.css')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->plugins([
                SystemInfoPlugin::make()
                    //->setSort(3),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                CustomerOverview::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
