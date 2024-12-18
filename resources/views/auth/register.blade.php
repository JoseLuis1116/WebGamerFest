<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fuente Pixelada de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        /* Fondo con imagen local */
        body {
            position: relative;
            background-image: url('{{ asset('images/fondo.jpg') }}');
            background-size: auto 100%;
            background-position: center top;
            background-repeat: no-repeat;
            background-color: black;
        }

        /* Overlay oscuro */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* Contenedores de texto con brillo */
        .input-container {
            background-color: #3d0066;
            border: 2px solid #ff00ff;
            box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
            color: #7fffd4;
            text-align: center;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }

        .input-container:focus {
            outline: none;
            box-shadow: 0 0 15px #ff00ff, 0 0 25px #ff00ff;
            border-color: #ff00ff;
        }

        /* Placeholder */
        .input-container::placeholder {
            color: #7fffd4;
            font-family: 'Press Start 2P', cursive;
            text-align: center;
        }

        /* Texto en Canva Sans */
        .canva-sans {
            font-family: 'Canva Sans', sans-serif;
            font-weight: 900; /* Negrilla más intensa */
            font-style: italic;
            font-size: 0.875rem;
            color: #ffffff;
        }


        /* Neon Borders */
        .neon-border {
            border: 2px solid #ff00ff;
            box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
        }

        /* Botón Ovalado con Neón */
        .neon-button {
            background-color: #240046;
            border: 3px solid #03f8fc;
            box-shadow: 0 0 10px #03f8fc, 0 0 20px #03f8fc;
            border-radius: 50px;
            padding: 12px 30px;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            transition: all 0.3s ease;
            font-family: 'Press Start 2P', cursive;
        }

        .neon-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 15px #03f8fc, 0 0 25px #03f8fc;
        }

        /* Título REGISTRO con CSS puro */
        .titulo {
            text-align: center; /* Centrado */
            font-size: 1.75rem; /* Tamaño de fuente */
            color: #ffffff; /* Color blanco */
            text-shadow: 0 0 8px #ff00ff, 0 0 12px #ff00ff; /* Sombra neón morado */
            font-family: 'Press Start 2P', cursive; /* Fuente pixelada */
            margin-bottom: 1.5rem; /* Espaciado inferior */
        }

        .error-message {
            color: #ffffff;
            font-size: 12px;
            margin-top: 0.25rem;
            font-weight: 900; /* Negrilla más intensa */
        }

    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="relative z-10 w-96 p-8 neon-border rounded-lg" style="background: rgba(255, 105, 180, 0.2);">
        <!-- Título -->
        <h2 class="titulo">REGISTRO</h2>

        <!-- Campos de entrada -->
        <form id="registroForm" action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <input type="text" name="Nombres" id="nombres" placeholder="NOMBRES" class="input-container w-full p-2 rounded-md">
                <p id="error-nombres" class="error-message hidden">Por favor, ingresa tus nombres.</p>
                
                <input type="text" name="Apellidos" id="apellidos" placeholder="APELLIDOS" class="input-container w-full p-2 rounded-md">
                <p id="error-apellidos" class="error-message hidden">Por favor, ingresa tus apellidos.</p>

                <input type="text" name="Celular" id="celular" placeholder="CELULAR" class="input-container w-full p-2 rounded-md">
                <p id="error-celular" class="error-message hidden">El número de celular debe tener exactamente 10 dígitos.</p>

                <!-- Selección de universidades -->
                <select name="Universidad" id="universidad" class="input-container w-full p-2 rounded-md">
                    <option value="" disabled selected>SELECCIONA TU UNIVERSIDAD</option>
                    <option value="ESPOL">Escuela Superior Politécnica del Litoral (ESPOL)</option>
                    <option value="UCE">Universidad Central del Ecuador (UCE)</option>
                    <option value="UTPL">Universidad Técnica Particular de Loja (UTPL)</option>
                    <option value="PUCE">Pontificia Universidad Católica del Ecuador (PUCE)</option>
                    <option value="UDLA">Universidad de Las Américas (UDLA)</option>
                    <option value="UCSG">Universidad Católica de Santiago de Guayaquil (UCSG)</option>
                    <option value="UTN">Universidad Técnica del Norte (UTN)</option>
                    <option value="UNL">Universidad Nacional de Loja (UNL)</option>
                    <option value="ESPE">Universidad de las Fuerzas Armadas (ESPE)</option>
                </select>
                <p id="error-universidad" class="error-message hidden">Por favor, selecciona una universidad.</p>

                <input type="email" name="CorreoElectronico" id="correo" placeholder="CORREO" class="input-container w-full p-2 rounded-md">
                <p id="error-correo" class="error-message hidden">El correo ingresado no es válido.</p>

                <input type="password" name="Contrasenia" id="password" placeholder="CONTRASEÑA" class="input-container w-full p-2 rounded-md">
                <p id="error-password" class="error-message hidden">La contraseña debe tener al menos 8 caracteres.</p>
                
                <input type="password" name="Contrasenia_confirmation" id="confirm-password" placeholder="CONFIRMAR CONTRASEÑA" class="input-container w-full p-2 rounded-md">
                <p id="error-confirm-password" class="error-message hidden">Las contraseñas no coinciden.</p>
            </div>

            <!-- Botón Ovalado -->
            <div class="mt-6 text-center">
                <button type="button" class="neon-button w-full py-2 rounded-md" onclick="validarFormulario()">GUARDAR</button>
            </div>
        </form>
    </div>


        <!-- Script de Validación -->
        <script>
        
        document.addEventListener('DOMContentLoaded', function () {
        function validarFormulario() {
            let isValid = true;

            document.querySelectorAll('.error-message').forEach(msg => msg.classList.add('hidden'));

            const nombres = document.getElementById('nombres').value.trim();
            if (!nombres) {
                document.getElementById('error-nombres').classList.remove('hidden');
                isValid = false;
            }

            if (isValid) {
                document.getElementById('registroForm').submit();
            }
        }
    });

        function validarFormulario() {
            let isValid = true;

            // Limpiar mensajes de error previos
            document.querySelectorAll('.error-message').forEach(msg => msg.classList.add('hidden'));

            // Nombres
            const nombres = document.getElementById('nombres').value.trim();
            if (!nombres) {
                document.getElementById('error-nombres').classList.remove('hidden');
                isValid = false;
            }

            // Apellidos
            const apellidos = document.getElementById('apellidos').value.trim();
            if (!apellidos) {
                document.getElementById('error-apellidos').classList.remove('hidden');
                isValid = false;
            }

            // Correo
            const correo = document.getElementById('correo').value.trim();
            const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!correoRegex.test(correo)) {
                document.getElementById('error-correo').classList.remove('hidden');
                isValid = false;
            }

            // Celular
            const celular = document.getElementById('celular').value.trim();
            if (!/^\d{10}$/.test(celular)) {
                document.getElementById('error-celular').classList.remove('hidden');
                isValid = false;
            }

            // Universidad
            const universidad = document.getElementById('universidad').value;
            if (!universidad) {
                document.getElementById('error-universidad').classList.remove('hidden');
                isValid = false;
            }

            // Contraseña
            const password = document.getElementById('password').value;
            if (password.length < 8) {
                document.getElementById('error-password').classList.remove('hidden');
                isValid = false;
            }

            // Confirmar Contraseña
            const confirmPassword = document.getElementById('confirm-password').value;
            if (password !== confirmPassword) {
                document.getElementById('error-confirm-password').classList.remove('hidden');
                isValid = false;
            }

            // Si todo es válido, enviar formulario
            if (isValid) {
                alert('Formulario enviado correctamente.');
                document.getElementById('registroForm').submit();
            }
        }
    </script>
</body>
</html>