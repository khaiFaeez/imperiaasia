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
    @if ($message = Session::get('success'))

    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 1000)" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-show="show">
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    </div>
    @endif

     <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" name="current_password" :value="old('current_password')" autocomplete="current-password" />
        </div>

        <div class="col-span-6">
            <x-label for="password" value="{{ __('New Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" name="password" :value="old('password')" autocomplete="new-password" />
        </div>

        <div class="col-span-6">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" name="password_confirmation" :value="old('password_confirmation')" autocomplete="new-password" />
        </div>
</div>
<div class="flex w-full justify-end mt-5">
        <x-button>
            {{ __('Confirm') }}
        </x-button>
</div>
</x-slot>
</x-app-layout>
