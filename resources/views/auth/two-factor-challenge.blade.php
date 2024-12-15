<x-guest-layout>
    <div class="logo-container">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="custom-logo">
    </div>
    <div class="auth-container">
        <div class="auth-form-container">
            <h2>VERIFICACIÓN EN DOS PASOS</h2>

            <div class="mb-4 text-sm text-white" x-data="{ recovery: false }" x-show="! recovery">
                {{ __('Por favor, confirma el acceso a tu cuenta ingresando el código de autenticación proporcionado por tu aplicación de autenticación.') }}
            </div>

            <div class="mb-4 text-sm text-white" x-cloak x-data="{ recovery: false }" x-show="recovery">
                {{ __('Por favor, confirma el acceso a tu cuenta ingresando uno de tus códigos de recuperación de emergencia.') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="input-group mt-4" x-data="{ recovery: false }" x-show="! recovery">
                    <i class="fa fa-key icon"></i>
                    <x-input id="code" class="block mt-1 w-full " type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" placeholder="CÓDIGO" />
                </div>

                <div class="input-group mt-4" x-cloak x-data="{ recovery: false }" x-show="recovery">
                    <i class="fa fa-shield icon"></i>
                    <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" placeholder="CÓDIGO DE RECUPERACIÓN" />
                </div>

                <div class="flex flex-col items-center justify-end mt-4 gap-4">
                    <button type="submit" class="auth-button">
                        {{ __('Verificar') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 hover:text-white underline cursor-pointer"
                            x-data="{ recovery: false }" x-show="! recovery"
                            x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                        {{ __('Usar un código de recuperación') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                            x-cloak x-data="{ recovery: false }" x-show="recovery"
                            x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                        {{ __('Usar un código de autenticación') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Fondo general negro */
        body {
            background-color: #000; /* Fondo negro */
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .auth-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 30px rgba(0, 255, 255, 0.7);
    max-width: 600px;
    width: 100%;
    margin-top: 50px;

    /* Fondo general del contenedor */
    background: url('{{ asset('images/fondo.jpg') }}') no-repeat center center;
    background-size: cover; /* Ajusta la imagen al tamaño sin distorsión */
}

.auth-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9); /* Capa opaca negra al 60% */
    backdrop-filter: blur(5px); /* Desenfoque del fondo */
    z-index: 0; /* Coloca el fondo detrás del contenido */
}

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: -35px;
            z-index: 10;
        }

        .custom-logo {
            max-width: 150px;
            box-shadow: 0 4px 30px rgba(0, 255, 255, 0.7);
        }

        .auth-form-container {
    position: relative; /* Coloca el contenido encima del pseudo-elemento */
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 20px;
}

        .auth-form-container h2 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #00ffff;
            text-shadow: 0px 0px 5px #00ffff;
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
            border: 2px solid #00ffff;
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

        .auth-button {
            margin: 0;
            padding: 8px 13px;
            width: 250px;
            background: #00ffff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-shadow: 0px 0px 5px #000;
            transition: background 0.3s ease;
        }

        .auth-button:hover {
            background: #00aaff;
        }

        @media (max-width: 768px) {
            .auth-container {
                padding: 20px;
            }

            .auth-form-container h2 {
                font-size: 20px;
            }

            .custom-logo {
                max-width: 120px;
            }
        }
    </style>
</x-guest-layout>
