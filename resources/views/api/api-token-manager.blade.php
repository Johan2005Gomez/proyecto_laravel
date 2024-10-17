<div>
    <!-- Generate API Token -->
    <x-form-section submit="createApiToken">
        <x-slot name="title">
            <span class="text-purple-700">{{ __('Create API Token') }}</span>
        </x-slot>

        <x-slot name="description">
            <span class="text-purple-500">{{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}</span>
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Token Name') }}" class="text-purple-600" />
                <x-input id="name" type="text" class="mt-1 block w-full border-purple-300 focus:border-purple-500 focus:ring-purple-500" wire:model="createApiTokenForm.name" autofocus />
                <x-input-error for="name" class="mt-2 text-purple-600" />
            </div>

            <!-- Token Permissions -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <x-label for="permissions" value="{{ __('Permissions') }}" class="text-purple-600" />
                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <x-checkbox wire:model="createApiTokenForm.permissions" :value="$permission" class="text-purple-600"/>
                                <span class="ms-2 text-sm text-purple-600">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3 text-purple-500" on="created">
                {{ __('Created.') }}
            </x-action-message>

            <x-button class="bg-purple-600 hover:bg-purple-700">
                {{ __('Create') }}
            </x-button>
        </x-slot>
    </x-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    <span class="text-purple-700">{{ __('Manage API Tokens') }}</span>
                </x-slot>

                <x-slot name="description">
                    <span class="text-purple-500">{{ __('You may delete any of your existing tokens if they are no longer needed.') }}</span>
                </x-slot>

                <!-- API Token List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div class="break-all text-purple-600">
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center ms-2">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-purple-400">
                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ms-6 text-sm text-purple-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permissions') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ms-6 text-sm text-purple-600" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <x-dialog-modal wire:model.live="displayingToken">
        <x-slot name="title">
            <span class="text-purple-700">{{ __('API Token') }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="text-purple-500">
                {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
            </div>

            <x-input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                class="mt-4 bg-purple-100 px-4 py-2 rounded font-mono text-sm text-purple-500 w-full break-all"
                autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled" class="bg-purple-500 hover:bg-purple-600">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- API Token Permissions Modal -->
    <x-dialog-modal wire:model.live="managingApiTokenPermissions">
        <x-slot name="title">
            <span class="text-purple-700">{{ __('API Token Permissions') }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <x-checkbox wire:model="updateApiTokenForm.permissions" :value="$permission" class="text-purple-600"/>
                        <span class="ms-2 text-sm text-purple-600">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled" class="bg-purple-500 hover:bg-purple-600">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3 bg-purple-600 hover:bg-purple-700" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingApiTokenDeletion">
        <x-slot name="title">
            <span class="text-purple-700">{{ __('Delete API Token') }}</span>
        </x-slot>

        <x-slot name="content">
            <span class="text-purple-500">{{ __('Are you sure you would like to delete this API token?') }}</span>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled" class="bg-purple-500 hover:bg-purple-600">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3 bg-purple-600 hover:bg-purple-700" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
