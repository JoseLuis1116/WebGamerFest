<x-guest-layout>
    <div class="password-reset-container">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="max-width: 150px; margin-bottom: 20px;">
        <div class="form-container">
            <h2>{{ __('Restablecer Contraseña') }}</h2>

            <div class="mb-4 text-sm text-white">
                {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente dinos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.') }}
            </div>

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group">
                    <i class="fa fa-envelope icon"></i>
                    <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Correo Electrónico" required autofocus autocomplete="username" />
                </div>

                <div style="margin-top: 15px;">
                    <button type="submit">{{ __('Enviar Enlace') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

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

    .password-reset-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.8);
        box-shadow: 0 4px 30px rgba(57, 255, 20, 0.7);
        max-width: 450px; 
        height: auto; 
        text-align: center;
    }

    .password-reset-container::before {
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
        justify-content: center;
        align-items: center;
        gap: 20px;
        width: 100%;
        padding: 20px;
    }

    .form-container h2 {
        font-size: 24px;
        margin-bottom: 5px;
        color: #39ff14;
        text-shadow: 0px 0px 10px #39ff14;
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
        border: 2px solid #39ff14;
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

    .form-container button {
        margin: 0;
        padding: 10px 15px;
        width: 200px;
        background: #39ff14;
        color: #000;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        text-shadow: 0px 0px 5px #000;
        transition: background 0.3s ease;
    }

    .form-container button:hover {
        background: #28cc10;
    }
</style>
