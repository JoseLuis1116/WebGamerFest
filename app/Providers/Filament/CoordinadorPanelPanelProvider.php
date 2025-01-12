<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Event; // Clase para eventos
use Illuminate\Auth\Events\Logout;  // Evento de cierre de sesión


class CoordinadorPanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        // Escucha el evento de logout
        Event::listen(Logout::class, function () {
            // Redirigir a 'home' al cerrar sesión
            return redirect()->route('home')->send();
        });

        return $panel
            ->default()
            ->id('coordinador') // Identificador único del panel
            ->path('coordinador') // Ruta base del panel
            ->login() // Configura la página de inicio de sesión predeterminada
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/CoordinadorPanel/Resources'), for: 'App\\Filament\\CoordinadorPanel\\Resources')
            ->discoverPages(in: app_path('Filament/CoordinadorPanel/Pages'), for: 'App\\Filament\\CoordinadorPanel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/CoordinadorPanel/Widgets'), for: 'App\\Filament\\CoordinadorPanel\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
