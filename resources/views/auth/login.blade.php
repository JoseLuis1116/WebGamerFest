<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            margin: 0;
            font-family: 'Poppins', sans-serif;
            padding: 10px;
            overflow: hidden;
        }

        .login-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 30px; /* Ajustado para mayor espacio */
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 30px rgba(255, 0, 255, 0.7);
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("images/fondo.jpg") }}') no-repeat center center;
            background-size: cover;
            filter: blur(5px);
            opacity: 0.9;
            z-index: -1;
        }

        .login-container img {
            max-width: 180px;
            margin-right: 20px;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px; /* Espaciado entre todos los elementos */
            width: 100%;
            padding: 10px;
        }

        .form-container h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: #ff00ff;
            text-shadow: 0px 0px 5px #ff00ff;
            text-align: center;
        }

        .input-group {
            position: relative;
            width: 100%;
            max-width: 350px; /* Tamaño máximo uniforme */
            margin: 0 auto;
            margin-bottom: 15px; /* Separación específica entre inputs */
        }

        .input-group input {
            padding-left: 35px;
            padding-right: 40px;
            width: 105%;
            max-width: 400px; /* Ancho uniforme */
            height: 40px;
            border-radius: 8px;
            border: 2px solid #ff00ff;
            background-color: #000;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .input-group .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
        }

        .input-group .toggle-password {
            position: absolute;
            top: -20%;
            right: -2px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            cursor: pointer;
            padding: 0;
            height: 20px;
            width: 20px;
            z-index: 2;
        }

        .form-container button {
            margin-top: 30px; /* Separación específica entre los inputs y el botón */
            padding: 10px 15px;
            width: 100%; /* Igual ancho que los inputs */
            max-width: 300px; /* Límite máximo para todas las pantallas */
            background: #ff00ff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-shadow: 0px 0px 5px #000;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #ff00aa;
        }

        .form-container a {
            color: #ff00aa;
            text-decoration: none;
            font-size: 14px;
        }

        .form-container a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .forgot-password {
            color: #ff00ff;
            font-size: 14px;
            margin-top: 10px;
        }

        .forgot-password:hover {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                padding: 15px;
                max-height: 95vh;
                overflow-y: auto;
            }

            .login-container img {
                max-width: 150px;
                margin-bottom: 15px;
            }

            .form-container h2 {
                font-size: 1.2rem;
            }

            .form-container button {
                width: 100%;
            }

            .input-group input {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }

            .input-group input {
                height: 35px;
                font-size: 12px;
            }

            .form-container h2 {
                font-size: 1rem;
            }

            .form-container button {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/logo.jpg') }}" alt="Gamer Fest Logo">
        <div class="form-container">
            <h2>INICIO DE SESIÓN</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <i class="fa fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="CORREO ELECTRÓNICO" required>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock icon"></i>
                    <input type="password" id="password" name="password" placeholder="CONTRASEÑA" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye" id="toggle-icon"></i>
                    </button>
                </div>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
            <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
            <a href="{{ route('register') }}">¿Todavía no tienes una cuenta? Regístrate</a>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
