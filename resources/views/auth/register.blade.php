<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Estilos personalizados */
        body {
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .registro-container {
            padding: 20px;
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 30px rgba(255, 255, 0, 0.7);
            max-width: 450px;
            width: 90%;
            text-align: center;
        }

        .registro-container h2 {
            font-size: 24px;
            color: #ffff00;
            text-shadow: 0px 0px 5px #ffff00;
            margin-bottom: 15px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            height: 40px;
            border: 2px solid #ffff00;
            border-radius: 8px;
            background: #000;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            padding: 5px 10px;
            box-sizing: border-box;
        }

        .input-group input::placeholder,
        .input-group select::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            background: #ffff00;
            color: #000;
            border: none;
            border-radius: 8px;
            height: 40px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        button:hover {
            background: #ffd700;
        }

        .links-container {
            margin-top: 10px;
            font-size: 14px;
        }

        .links-container a {
            color: #ffff00;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <h2>Registro de Usuario</h2>

        <!-- Mensajes de sesión -->
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

        <!-- Formulario de registro -->
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <!-- Nombres -->
            <div class="input-group">
                <input type="text" name="Nombres" placeholder="Nombres" value="{{ old('Nombres') }}">
                @error('Nombres')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Apellidos -->
            <div class="input-group">
                <input type="text" name="Apellidos" placeholder="Apellidos" value="{{ old('Apellidos') }}">
                @error('Apellidos')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Celular -->
            <div class="input-group">
                <input type="text" name="Celular" placeholder="Celular" value="{{ old('Celular') }}">
                @error('Celular')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Universidad -->
            <div class="input-group">
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

            <!-- Correo -->
            <div class="input-group">
                <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="input-group">
                <input type="password" name="Contrasenia" placeholder="Contraseña">
                @error('Contrasenia')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="input-group">
                <input type="password" name="Contrasenia_confirmation" placeholder="Confirmar Contraseña">
            </div>

            <!-- Botón -->
            <button type="submit">Guardar</button>
        </form>

        <!-- Enlaces -->
        <div class="links-container">
            <a href="/login">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</body>
</html>
