@extends('layouts.app')

@section('title', 'Booking Confirmation - LuxStay')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h2 class="mt-4 text-2xl font-bold text-gray-900">Booking Confirmed!</h2>
            <p class="mt-2 text-gray-600">Your reservation has been successfully processed.</p>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-8">
            <h3 class="text-lg font-semibold text-gray-900">Booking Details</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Check In</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->check_in->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Check Out</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->check_out->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Number of Guests</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->guests }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($booking->total_price, 2) }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('rooms.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Browse More Rooms
            </a>
        </div>
    </div>
</div>
@endsection 