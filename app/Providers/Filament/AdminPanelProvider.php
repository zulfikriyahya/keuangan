<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Widgets\SaldoOverview;
use App\Filament\Resources\UserResource;
use App\Filament\Widgets\JurnalOverview;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->sidebarFullyCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->brandLogo(fn() => view('logo'))
            ->brandLogoHeight('1.25rem')
            ->topNavigation()
            // ->topbar(false)
            ->spa()
            ->maxContentWidth(MaxWidth::Full)
            ->unsavedChangesAlerts()
            ->databaseNotifications()

            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // AccountWidget::class,
                SaldoOverview::class,
                JurnalOverview::class,
            ])
            ->plugins([
                // \TomatoPHP\FilamentPWA\FilamentPWAPlugin::make()
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Pengguna')
                    ->url(fn(): string => UserResource::getUrl())
                    ->icon('heroicon-o-identification'),
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
