<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            overflow-y: auto;
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
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        .profile-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #00ffff;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
        }

        @keyframes neonGlow {
            0% {
                text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000, 0 0 30px #ff0000, 0 0 40px #ff0000;
            }
            100% {
                text-shadow: 0 0 10px #ffff00, 0 0 20px #ffff00, 0 0 30px #ffff00, 0 0 40px #ffff00;
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

            .section-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2 class="profile-title">Perfil de Usuario</h2>

        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="profile-section">
                <h3 class="section-title"><i class="fas fa-user-edit"></i> Actualizar Información del Perfil</h3>
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="profile-section">
                <h3 class="section-title"><i class="fas fa-key"></i> Actualizar Contraseña</h3>
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="profile-section">
                <h3 class="section-title"><i class="fas fa-shield-alt"></i> Autenticación de Dos Factores</h3>
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <div class="profile-section">
            <h3 class="section-title"><i class="fas fa-sign-out-alt"></i> Cerrar Sesiones</h3>
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="profile-section">
                <h3 class="section-title"><i class="fas fa-trash"></i> Eliminar Cuenta</h3>
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</body>
</html>
