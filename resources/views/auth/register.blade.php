<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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

        .registro-container {
            padding: 10px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 30px rgba(255, 255, 0, 0.7);
            max-width: 450px;
            min-height: 100px;
            width: 90%;
            text-align: center;
        }

        .registro-container::before {
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

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
        }

        .form-container h2 {
            font-size: 24px;
            margin-bottom: 3px;
            color: #ffff00;
            text-shadow: 0px 0px 5px #ffff00;
        }

        .input-group {
            position: relative;
            width: 100%;
            max-width: 350px;
            text-align: left;
            margin-bottom: 15px;
        }

        .input-group input,
        .input-group select {
            padding-left: 10px;
            width: 100%;
            height: 40px;
            border-radius: 8px;
            border: 2px solid #ffff00;
            background-color: #000;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        .input-group input::placeholder,
        .input-group select::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-container button {
            padding: 10px 15px;
            width: 100%;
            max-width: 350px;
            background: #ffff00;
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-shadow: 0px 0px 5px #000;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #ffeb3b;
        }

        .form-container a {
            color: #ffff00;
            text-decoration: none;
            font-size: 14px;
        }

        .form-container a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .error-message {
            color: #ff0000;
            font-size: 12px;
            margin-top: 0.25rem;
            text-align: left;
            display: none;
        }

        .error-visible {
            display: block;
        }

        .links-container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <div class="form-container">
            <h2>REGISTRO</h2>
            <form id="registroForm" action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="Nombres" id="nombres" placeholder="NOMBRES">
                    <p id="error-nombres" class="error-message">Por favor, ingresa tus nombres.</p>
                </div>

                <div class="input-group">
                    <input type="text" name="Apellidos" id="apellidos" placeholder="APELLIDOS">
                    <p id="error-apellidos" class="error-message">Por favor, ingresa tus apellidos.</p>
                </div>

                <div class="input-group">
                    <input type="text" name="Celular" id="celular" placeholder="CELULAR">
                    <p id="error-celular" class="error-message">El número de celular debe tener exactamente 10 dígitos.</p>
                </div>

                <div class="input-group">
                    <select name="Universidad" id="universidad">
                        <option value="" disabled selected>SELECCIONA TU UNIVERSIDAD</option>
                        <option value="ESPOL">Escuela Superior Politécnica del Litoral (ESPOL)</option>
                        <option value="UCE">Universidad Central del Ecuador (UCE)</option>
                        <option value="UTPL">Universidad Técnica Particular de Loja (UTPL)</option>
                        <option value="PUCE">Pontificia Universidad Católica del Ecuador (PUCE)</option>
                        <option value="UDLA">Universidad de Las Américas (UDLA)</option>
                        <option value="UCSG">Universidad Católica de Santiago de Guayaquil (UCSG)</option>
                        <option value="UTN">Universidad Técnica del Norte (UTN)</option>
                        <option value="UNL">Universidad Nacional de Loja (UNL)</option>
                        <option value="ESPE">Universidad de las Fuerzas Armadas (ESPE)</option>
                    </select>
                    <p id="error-universidad" class="error-message">Por favor, selecciona una universidad.</p>
                </div>

                <div class="input-group">
                    <input type="email" name="CorreoElectronico" id="correo" placeholder="CORREO">
                    <p id="error-correo" class="error-message">El correo ingresado no es válido.</p>
                </div>

                <div class="input-group">
                    <input type="password" name="Contrasenia" id="password" placeholder="CONTRASEÑA">
                    <p id="error-password" class="error-message">La contraseña debe tener al menos 8 caracteres.</p>
                </div>

                <div class="input-group">
                    <input type="password" name="Contrasenia_confirmation" id="confirm-password" placeholder="CONFIRMAR CONTRASEÑA">
                    <p id="error-confirm-password" class="error-message">Las contraseñas no coinciden.</p>
                </div>

                <button type="button" onclick="validarFormulario()">GUARDAR</button>

                <div class="links-container">
                    <a href="/login">Regresar al inicio de sesión</a><br>
                    <a href="/register">Recargar registro</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validarFormulario() {
            let isValid = true;
            document.querySelectorAll('.error-message').forEach(msg => msg.classList.remove('error-visible'));

            const nombres = document.getElementById('nombres').value.trim();
            if (!nombres) {
                document.getElementById('error-nombres').classList.add('error-visible');
                isValid = false;
            }

            const apellidos = document.getElementById('apellidos').value.trim();
            if (!apellidos) {
                document.getElementById('error-apellidos').classList.add('error-visible');
                isValid = false;
            }

            const correo = document.getElementById('correo').value.trim();
            const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!correoRegex.test(correo)) {
                document.getElementById('error-correo').classList.add('error-visible');
                isValid = false;
            }

            const celular = document.getElementById('celular').value.trim();
            if (!/^\d{10}$/.test(celular)) {
                document.getElementById('error-celular').classList.add('error-visible');
                isValid = false;
            }

            const universidad = document.getElementById('universidad').value;
            if (!universidad) {
                document.getElementById('error-universidad').classList.add('error-visible');
                isValid = false;
            }

            const password = document.getElementById('password').value;
            if (password.length < 8) {
                document.getElementById('error-password').classList.add('error-visible');
                isValid = false;
            }

            const confirmPassword = document.getElementById('confirm-password').value;
            if (password !== confirmPassword) {
                document.getElementById('error-confirm-password').classList.add('error-visible');
                isValid = false;
            }

            if (isValid) {
                document.getElementById('registroForm').submit();
            }
        }
    </script>
</body>
</html>
