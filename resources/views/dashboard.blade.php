<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card w-96 bg-red-300 text-white">
                <div class="card-body">
                    <h2 class="card-title">Platinum</h2>
                    <div class="card-actions justify-end">
                    <button class="btn bg-ghost">Go</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
