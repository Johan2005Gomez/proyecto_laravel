<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualizar Contraseña') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerla segura.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Contraseña actual -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Contraseña Actual') }}" class="text-gray-700" />
            <x-input id="current_password" type="password" class="mt-1 block w-full border-gray-300" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <!-- Nueva contraseña -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Nueva Contraseña') }}" class="text-gray-700" />
            <x-input id="password" type="password" class="mt-1 block w-full border-gray-300" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" class="text-gray-700" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full border-gray-300" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved" class="text-green-600">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button class="bg-purple-600 hover:bg-purple-500 transition duration-200">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
