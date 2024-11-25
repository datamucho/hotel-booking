<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->max_guests,
            'special_requests' => 'nullable|string|max:500',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->room_id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'special_requests' => $validated['special_requests'],
            'total_price' => $room->price_per_night * 
                            (strtotime($validated['check_out']) - strtotime($validated['check_in'])) / 86400,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', 'Your booking has been submitted successfully!');
    }

    public function confirmation(Booking $booking)
    {
        // Ensure users can only see their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.confirmation', compact('booking'));
    }

    public function index()
    {
        $bookings = Booking::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }
} 