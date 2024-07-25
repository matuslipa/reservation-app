<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-md	 mx-auto sm:px-6 lg:px-8" style="max-width: 40rem">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container max-w-3xl	 p-6 text-center">
                    <h1 class="mb-4"><b>Make a Reservation</b></h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="alert alert-warning">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 max-w-md">
                            <label for="restaurant_table_id" class="form-label">Table</label>
                            <select name="restaurant_table_id" id="restaurant_table_id" class="form-control">
                                @foreach($tables as $table)
                                    <option value="{{ $table->id }}">{{ $table->name }} ({{ $table->seats }} seats)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reservation_time" class="form-label">Reservation Time</label>
                            <input type="datetime-local" name="reservation_time" id="reservation_time"
                                   class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
