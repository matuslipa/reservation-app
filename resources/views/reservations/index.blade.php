<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container text-center p-6">
                    <div class="mb-4">
                        <h1><b>Your Reservations</b></h1>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Reservation Time</th>
                            <th scope="col">Table Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->reservation_time }}</td>
                                <td>Table #{{ $reservation->restaurant_table_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden mt-10 shadow-sm sm:rounded-lg text-center">
                <a href="{{ route('reservations.create') }}" class="btn btn-primary bg-amber-800">Make a Reservation</a>
            </div>
        </div>
    </div>
</x-app-layout>
