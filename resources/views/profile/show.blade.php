<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    @vite('resources/css/stilo.css')
</head>
<body>
    <div class="profile-container">
        <h2 class="profile-title">Perfil de Usuario</h2>

        <!-- Sección de Actualización de Información del Perfil -->
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="profile-section">
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        <!-- Sección de Actualización de Contraseña -->
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="profile-section">
                @livewire('profile.update-password-form')
            </div>
        @endif

        <!-- Sección de Autenticación de Dos Factores -->
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="profile-section">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <!-- Sección para Cerrar Sesiones en Otros Navegadores -->
        <div class="profile-section">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        <!-- Sección de Eliminación de Cuenta -->
        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="profile-section">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</body>
</html>
