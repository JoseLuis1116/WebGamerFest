<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Neón</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #000, #222);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            padding: 20px; /* Para evitar problemas en pantallas pequeñas */
            box-sizing: border-box;
        }

        .registro-container {
            position: relative;
            padding: 30px;
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.7); /* Transparencia ajustada */
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5), 0 0 50px rgba(0, 255, 255, 0.3);
            max-width: 450px;
            width: 100%;
            text-align: center;
            animation: glowIn 1.5s ease-out;
            overflow: hidden;
        }

        .registro-container img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 600px;
            height: auto;
            opacity: 0.2; /* Más visible, pero sin afectar legibilidad */
            z-index: -1; /* Coloca la imagen detrás del contenido */
        }

        @keyframes glowIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .registro-container h2 {
            font-size: 24px;
            color: #0ff;
            text-shadow: 0px 0px 10px #0ff, 0px 0px 20px #0ff;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.6);
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            padding: 10px 15px 10px 45px;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 255, 255, 0.5), 0 0 10px rgba(0, 255, 255, 0.2);
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            box-shadow: 0 0 10px #0ff, 0 0 30px #0ff;
            transform: scale(1.05);
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 18px;
        }

        .error-message {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            background: linear-gradient(135deg, #0ff, #00f);
            color: #000;
            border: none;
            border-radius: 12px;
            height: 45px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            box-shadow: 0 0 15px #0ff, 0 0 30px #0ff;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #00f, #0ff);
            box-shadow: 0 0 20px #00f, 0 0 40px #00f;
        }

        .links-container {
            margin-top: 20px;
            font-size: 14px;
        }

        .links-container a {
            color: #0ff;
            text-decoration: none;
            text-shadow: 0 0 10px #0ff;
            transition: color 0.3s ease;
        }

        .links-container a:hover {
            color: #00f;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .registro-container {
                padding: 20px;
            }

            .registro-container h2 {
                font-size: 20px;
            }

            .input-group input,
            .input-group select {
                font-size: 14px;
                height: 40px;
            }

            button {
                font-size: 14px;
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .registro-container {
                padding: 15px;
            }

            .registro-container h2 {
                font-size: 18px;
            }

            .input-group input,
            .input-group select {
                font-size: 12px;
                height: 35px;
            }

            button {
                font-size: 12px;
                height: 35px;
            }
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <!-- Imagen de fondo -->
        <img src="{{ asset('images/logo.jpg') }}" alt="Gamer Fest Logo">

        <h2>Registro de Usuario</h2>

        @if (session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="color: red; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="Nombres" placeholder="Nombres" value="{{ old('Nombres') }}">
                @error('Nombres')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="Apellidos" placeholder="Apellidos" value="{{ old('Apellidos') }}">
                @error('Apellidos')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa fa-phone"></i>
                <input type="text" name="Celular" placeholder="Celular" value="{{ old('Celular') }}">
                @error('Celular')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa fa-graduation-cap"></i>
                <select name="Universidad">
                    <option value="" disabled selected>Selecciona tu universidad</option>
                    <option value="ESPE" {{ old('Universidad') == 'ESPE' ? 'selected' : '' }}>ESPE</option>
                    <option value="ESPOL" {{ old('Universidad') == 'ESPOL' ? 'selected' : '' }}>ESPOL</option>
                    <option value="UCE" {{ old('Universidad') == 'UCE' ? 'selected' : '' }}>UCE</option>
                    <option value="UTPL" {{ old('Universidad') == 'UTPL' ? 'selected' : '' }}>UTPL</option>
                    <option value="PUCE" {{ old('Universidad') == 'PUCE' ? 'selected' : '' }}>PUCE</option>
                    <option value="UDLA" {{ old('Universidad') == 'UDLA' ? 'selected' : '' }}>UDLA</option>
                </select>
                @error('Universidad')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="Contrasenia" placeholder="Contraseña">
                @error('Contrasenia')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="Contrasenia_confirmation" placeholder="Confirmar Contraseña">
            </div>

            <button type="submit">Guardar</button>
        </form>

        <div class="links-container">
            <a href="/login">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</body>
</html>
