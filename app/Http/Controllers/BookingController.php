<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;


class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['car', 'user'])->get();

        return view('admin/dashboard', compact('bookings'));
    }
}
