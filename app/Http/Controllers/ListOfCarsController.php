<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;

class ListOfCarsController extends Controller
{
    public function view()
    {
        return view('public/list-of-cars');
    }

    public function getAvailableCars(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $availableCars = Car::whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
        $query->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate]);
        });
    })->get();

    return response()->json(['available_cars' => $availableCars]);
    }
}
