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
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Event; // Clase para eventos
use Illuminate\Auth\Events\Logout;  // Evento de cierre de sesión

class ParticipantPanelPanelProvider extends PanelProvider
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
            ->id('participantes')
            ->path('participantes')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/ParticipantPanel/Resources'), for: 'App\\Filament\\ParticipantPanel\\Resources')
            ->discoverPages(in: app_path('Filament/ParticipantPanel/Pages'), for: 'App\\Filament\\ParticipantPanel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/ParticipantPanel/Widgets'), for: 'App\\Filament\\ParticipantPanel\\Widgets')
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
