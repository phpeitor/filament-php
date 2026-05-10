<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\SystemInfoWidget;
use App\Filament\Resources\CustomerResource\Widgets\UserOverview;
use App\Filament\Resources\CustomerResource\Widgets\UserChartOverview;
use App\Filament\Resources\CustomerResource\Widgets\MeetingOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Enums\UserMenuPosition;
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

class PhpeitorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarFullyCollapsibleOnDesktop()
            ->default()
            ->profile()
            ->topbar()
            ->userMenu(position: UserMenuPosition::Topbar)
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->brandName(name: 'PHPeitor')
            ->defaultThemeMode(ThemeMode::Dark)
            ->brandLogo(fn(): View => view('filament.logo'))
            ->brandLogoHeight(fn() => auth()->check() ? '3.75rem' : '3.95rem')
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
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                SystemInfoWidget::class,
                UserOverview::class,
                MeetingOverview::class,
                UserChartOverview::class,
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
