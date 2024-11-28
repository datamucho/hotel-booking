<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Booking $booking)
    {
        if ($booking->payment || $booking->status === 'cancelled') {
            return redirect()->route('bookings.index')
                ->with('error', 'This booking has already been paid or cancelled.');
        }

        return view('payments.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:Credit Card,PayPal,Cash',
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'payment_date' => now(),
            'payment_method' => $request->payment_method,
            'amount' => $booking->total_price,
        ]);

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('bookings.index')
            ->with('success', 'Payment processed successfully!');
    }
} 