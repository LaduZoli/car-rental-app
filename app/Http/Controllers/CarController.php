<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class CarController extends Controller
{
    public function showAvailableCars(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $availableCars = Car::where('status', true)
            ->whereNotIn('id', function ($query) use ($startDate, $endDate) {
            $query->from('bookings')
                ->whereDate('start_date', '<=', $endDate)
                ->whereDate('end_date', '>=', $startDate)
                ->select('car_id');
        })->get();

        return view('public/list-of-cars', ['availableCars' => $availableCars]);
    }

    public function showBookingForm($carId)
    {
        $car = Car::find($carId);

        return view('public/car-booking')->with('car', $car);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'e_mail' => $request->input('email'),
            'address' => $request->input('address'),
            'telephone_number' => $request->input('phone'),
            'days_booked' => $request->input('days'),
            'total_amount' => $request->input('amount'),
        ]);

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'car_id' => 'required|exists:cars,id',
        ]);


        $booking = Booking::create([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'car_id' => $request->input('car_id'),
            'user_id' => $user->id,
            
        ]);

        return response()->json(['message' => 'Sikeres foglalás']);
    }

    public function index()
    {
        $cars = Car::all();

        return view('admin/car-edit', compact('cars'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'daily_price' => 'required|numeric|min:0',
            'img_src' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $car = new Car();
        $car->name = $request->input('name');
        $car->daily_price = $request->input('daily_price');
    
        if ($request->hasFile('img_src')) {
            $imagePath = $request->file('img_src')->store('car_images', 'public_img');
            $car->img_src = $imagePath;
        }

        $car->save();

        return redirect()->route('index')->with('success', 'Az autó sikeresen felvéve.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($carId)
    {
        $car = Car::find($carId);
        return view('admin/carid-edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $car = Car::find($id);

    if (!$car) {
        return redirect()->route('index')->with('error', 'Az autó nem található.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'daily_price' => 'required|numeric|min:0',
        'status' => 'boolean',
        'img_src' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $car->name = $request->input('name');
    $car->daily_price = $request->input('daily_price');
    $car->status = $request->input('status')? true : false;

    if ($request->hasFile('img_src')) {
        if ($car->img_src) {
            Storage::disk('public_img')->delete($car->img_src);
        }

        $imagePath = $request->file('img_src')->store('car_images', 'public_img');
        $car->img_src = $imagePath;
    }

    info('Updated Car Data:', [
        'car_id' => $car->id,
        'name' => $car->name,
        'daily_price' => $car->daily_price,
        'status' => $car->status,
        'img_src' => $car->img_src,
    ]);

    $car->save();

    return redirect()->route('index')->with('success', 'Az autó sikeresen frissítve.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
