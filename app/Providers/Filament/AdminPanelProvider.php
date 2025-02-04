<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Filament\Widgets\AccountWidget;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Widgets\SaldoOverview;
use App\Filament\Resources\UserResource;
use App\Filament\Widgets\JurnalOverview;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
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
            // ->sidebarFullyCollapsibleOnDesktop()
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
            ->spa()
            ->maxContentWidth(MaxWidth::Full)
            ->unsavedChangesAlerts()
            ->databaseNotifications()

            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                SaldoOverview::class,
            ])
            ->plugins([
                // \TomatoPHP\FilamentPWA\FilamentPWAPlugin::make(),

                EasyFooterPlugin::make()
                    ->withFooterPosition('footer')
                    ->withSentence(new HtmlString('
                    <img src="/default/foto.png" alt="Logo Aplikasi" width="20" height="20"> MTs Negeri 1 Pandeglang'))
                    // ->withGithub(showLogo: true, showUrl: true)
                    ->withLoadTime('Halaman ini dimuat dalam')
                    // ->withLogo('https://static.cdnlogo.com/logos/l/23/laravel.svg', 'https://laravel.com')
                    ->withBorder()
                    ->hiddenFromPagesEnabled()
                    ->hiddenFromPages(['sample-page', 'another-page', 'admin/login', 'admin/forgot-password', 'admin/register']),

                // FilamentShieldPlugin::make()
                //     ->gridColumns([
                //         'default' => 1,
                //         'sm' => 2,
                //         'lg' => 3
                //     ])
                //     ->sectionColumnSpan(1)
                //     ->checkboxListColumns([
                //         'default' => 1,
                //         'sm' => 2,
                //         'lg' => 4,
                //     ])
                //     ->resourceCheckboxListColumns([
                //         'default' => 1,
                //         'sm' => 2,
                //     ]),
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
