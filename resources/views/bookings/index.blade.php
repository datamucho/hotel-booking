@extends('layouts.app')

@section('title', 'My Bookings - Harbour')

@section('content')
<div class="min-h-full flex flex-col">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full flex-1">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Bookings</h1>

        @if($bookings->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-600">You haven't made any bookings yet.</p>
                <a href="{{ route('rooms.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-700">
                    Browse Available Rooms
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div class="lg:flex lg:items-center lg:justify-between">
                                <div class="min-w-0 flex-1">
                                    <h2 class="text-xl font-bold text-gray-900">
                                        {{ ucwords(str_replace('_', ' ', $booking->room->room_type)) }}
                                    </h2>
                                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <span>Check-in: {{ $booking->check_in->format('M d, Y') }}</span>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <span>Check-out: {{ $booking->check_out->format('M d, Y') }}</span>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <span>Guests: {{ $booking->guests }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex lg:mt-0 lg:ml-4">
                                    <span class="inline-flex rounded-md shadow-sm">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                                            @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </span>
                                    
                                    @if(in_array($booking->status, ['pending', 'confirmed']))
                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="ml-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')"
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                                Cancel Booking
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Price:</span>
                                    <span class="text-lg font-semibold text-gray-900">
                                        ${{ number_format($booking->total_price, 2) }}
                                    </span>
                                </div>
                                @if($booking->special_requests)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-900">Special Requests:</h4>
                                        <p class="mt-1 text-sm text-gray-600">{{ $booking->special_requests }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 border-t border-gray-200 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Price:</span>
                        <span class="text-lg font-semibold text-gray-900">
                            ${{ number_format($bookings->sum('total_price'), 2) }}
                        </span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 