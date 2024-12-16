<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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

        .login-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 40px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 30px rgba(255, 0, 255, 0.7);
            max-width: 600px;
            width: 90%;
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
            max-width: 250px;
            margin-right: 30px;
            border-radius: 10px;
            z-index: 1;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
            width: 100%;
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
        }

        .form-container h2 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #ff00ff;
            text-shadow: 0px 0px 5px #ff00ff;
        }

        .input-group {
            position: relative;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .input-group input {
            padding-left: 35px;
            padding-right: 40px;
            width: 100%;
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
            top: 50%;
            right: 10px;
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

        .input-group .toggle-password i {
            font-size: 14px;
        }

        .form-container button {
            margin: 0;
            padding: 10px 15px;
            width: 200px;
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
