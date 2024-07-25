<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Make a new Reservation</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('reservations.index') }}" class="btn btn-primary">Show reservations</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
