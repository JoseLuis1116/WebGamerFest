<x-action-section>
    <x-slot name="title">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('Autenticación de Dos Factores') }}
        </h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-lg text-gray-700">
            {{ __('Añade seguridad adicional a tu cuenta utilizando la autenticación de dos factores.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <h3 class="text-xl font-semibold text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Termina de habilitar la autenticación de dos factores.') }}
                @else
                    {{ __('Has habilitado la autenticación de dos factores.') }}
                @endif
            @else
                {{ __('No has habilitado la autenticación de dos factores.') }}
            @endif
        </h3>

        <div class="mt-5 max-w-xl text-lg text-gray-700">
            <p>
                {{ __('Cuando se habilita la autenticación de dos factores, se te pedirá un token seguro y aleatorio durante la autenticación. Puedes obtener este token desde la aplicación Google Authenticator en tu teléfono.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-6 max-w-xl text-lg text-gray-700">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de habilitar la autenticación de dos factores, escanea el siguiente código QR utilizando la aplicación de autenticación en tu teléfono o introduce la clave de configuración y proporciona el código OTP generado.') }}
                        @else
                            {{ __('La autenticación de dos factores ahora está habilitada. Escanea el siguiente código QR utilizando la aplicación de autenticación en tu teléfono o introduce la clave de configuración.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-6 p-4 inline-block bg-white border-2 border-gray-300 rounded-lg">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-6 max-w-xl text-lg text-gray-700">
                    <p class="font-semibold">
                        {{ __('Clave de Configuración') }}: <span class="text-gray-900 text-lg font-mono">{{ decrypt($this->user->two_factor_secret) }}</span>
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-6">
                        <x-label for="code" value="{{ __('Código') }}" class="text-lg font-semibold" />
                        <x-input id="code" type="text" name="code" class="block mt-2 w-3/4 text-lg" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />
                        <x-input-error for="code" class="mt-2 text-red-500 text-lg" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-6 max-w-xl text-lg text-gray-700">
                    <p class="font-semibold">
                        {{ __('Guarda estos códigos de recuperación en un administrador de contraseñas seguro. Pueden ser utilizados para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación de dos factores.') }}
                    </p>
                </div>

                <div class="grid gap-2 max-w-xl mt-6 px-4 py-4 font-mono text-lg bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div class="text-gray-900">{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-8">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled" class="px-6 py-3 text-lg">
                        {{ __('Habilitar') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3 px-6 py-3 text-lg">
                            {{ __('Regenerar Códigos de Recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="me-3 px-6 py-3 text-lg" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="me-3 px-6 py-3 text-lg">
                            {{ __('Mostrar Códigos de Recuperación') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled" class="px-6 py-3 text-lg">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled" class="px-6 py-3 text-lg">
                            {{ __('Deshabilitar') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
