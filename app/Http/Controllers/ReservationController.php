<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $reservations = Auth::user()->reservations()->with('restaurantTable')->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $tables = RestaurantTable::all();
        return view('reservations.create', compact('tables'));
    }

    /**
     * @param \App\Http\Requests\StoreReservationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReservationRequest $request): \Illuminate\Http\RedirectResponse
    {
        Auth::user()->reservations()->create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * @param \App\Models\Reservation $reservation
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reservation $reservation): \Illuminate\Http\RedirectResponse
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
    }
}
