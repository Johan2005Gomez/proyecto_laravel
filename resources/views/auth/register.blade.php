<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="container">
            <h2 class="text-2xl font-semibold text-purple-700">Registro</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Name') }}" class="text-purple-700"/>
                    <x-input id="name" class="block mt-1 w-full border-purple-500 focus:border-purple-700 focus:ring-purple-700" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-purple-700"/>
                    <x-input id="email" class="block mt-1 w-full border-purple-500 focus:border-purple-700 focus:ring-purple-700" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-purple-700"/>
                    <x-input id="password" class="block mt-1 w-full border-purple-500 focus:border-purple-700 focus:ring-purple-700" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-purple-700"/>
                    <x-input id="password_confirmation" class="block mt-1 w-full border-purple-500 focus:border-purple-700 focus:ring-purple-700" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="role" value="{{ __('Role') }}" class="text-purple-700"/>
                    <select id="role" name="role" class="block mt-1 w-full border-purple-500 focus:border-purple-700 focus:ring-purple-700" required>
                        <option value="" disabled selected>Selecciona un rol</option>
                        <option value="vendedor">Vendedor</option>
                        <option value="comprador">Comprador</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="mt-4 bg-purple-700 hover:bg-purple-800 focus:bg-purple-800">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
