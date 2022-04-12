<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
    <div class="stats shadow mb-5">

        <div class="stat place-items-center">
            <div class="stat-title">Downloads</div>
            <div class="stat-value">31K</div>
            <div class="stat-desc">From January 1st to February 1st</div>
        </div>

        <div class="stat place-items-center">
            <div class="stat-title">Users</div>
            <div class="stat-value text-secondary">4,200</div>
            <div class="stat-desc text-secondary">↗︎ 40 (2%)</div>
        </div>

        <div class="stat place-items-center">
            <div class="stat-title">New Registers</div>
            <div class="stat-value">1,200</div>
            <div class="stat-desc">↘︎ 90 (14%)</div>
        </div>

        </div>

        <div class="grid grid-cols-3 gap-3">
             <a href="{{ route('users.create') }}" class="btn btn-neutral">Create User</a>

        </div>
        </x-slot>
</x-app-layout>
