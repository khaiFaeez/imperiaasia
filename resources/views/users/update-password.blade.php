<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Update Password') }}
        </h2>
         <div class="flex items-start justify-start">
            <a class="btn btn-ghost btn-sm" href="{{ route('users.index') }}"> Back</a>
         </div>
    </x-slot>

    <x-slot name="slot">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
        </div>
    </x-slot>

        <x-button>
            {{ __('Save') }}
        </x-button>
</x-slot>
</x-app-layout>
