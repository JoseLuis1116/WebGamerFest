<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        body {
            background: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
        }

        .profile-container {
            width: 100%;
            height: 100%;
            text-align: center;
            padding: 20px;
            border-radius: 0;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: none;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .profile-title {
            font-size: 2rem;
            text-transform: uppercase;
            margin-bottom: 30px;
            color: #fff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                         0 0 20px rgba(255, 0, 0, 0.7),
                         0 0 30px rgba(0, 255, 0, 0.7),
                         0 0 40px rgba(0, 0, 255, 0.7);
            animation: neonGlow 5s infinite alternate;
        }

        .profile-section {
            width: 90%;
            max-width: 800px;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: neonBackground 7s infinite alternate;
            box-sizing: border-box;
        }

        .profile-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        }

        svg {
            width: 40px;
            height: 40px;
            animation: neonSvg 6s infinite alternate;
        }

        @keyframes neonGlow {
            0% {
                text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000, 0 0 30px #ff0000, 0 0 40px #ff0000;
            }
            25% {
                text-shadow: 0 0 10px #00ff00, 0 0 20px #00ff00, 0 0 30px #00ff00, 0 0 40px #00ff00;
            }
            50% {
                text-shadow: 0 0 10px #0000ff, 0 0 20px #0000ff, 0 0 30px #0000ff, 0 0 40px #0000ff;
            }
            75% {
                text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff;
            }
            100% {
                text-shadow: 0 0 10px #ffff00, 0 0 20px #ffff00, 0 0 30px #ffff00, 0 0 40px #ffff00;
            }
        }

        @keyframes neonBackground {
            0% {
                background: rgba(255, 0, 0, 0.1);
                box-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000;
            }
            25% {
                background: rgba(0, 255, 0, 0.1);
                box-shadow: 0 0 10px #00ff00, 0 0 20px #00ff00;
            }
            50% {
                background: rgba(0, 0, 255, 0.1);
                box-shadow: 0 0 10px #0000ff, 0 0 20px #0000ff;
            }
            75% {
                background: rgba(255, 0, 255, 0.1);
                box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
            }
            100% {
                background: rgba(255, 255, 0, 0.1);
                box-shadow: 0 0 10px #ffff00, 0 0 20px #ffff00;
            }
        }

        @keyframes neonSvg {
            0% {
                fill: #ff0000;
            }
            25% {
                fill: #00ff00;
            }
            50% {
                fill: #0000ff;
            }
            75% {
                fill: #ff00ff;
            }
            100% {
                fill: #ffff00;
            }
        }

        @media (max-width: 768px) {
            .profile-title {
                font-size: 1.5rem;
            }

            .profile-section {
                width: 95%;
                padding: 15px;
            }

            svg {
                width: 30px;
                height: 30px;
            }
        }

        @media (max-width: 480px) {
            .profile-title {
                font-size: 1.2rem;
            }

            .profile-section {
                width: 100%;
                padding: 10px;
            }

            svg {
                width: 25px;
                height: 25px;
            }
        }
    </style>
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
