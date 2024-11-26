@extends('layouts.app')

@section('title', 'Book Room - LuxStay')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12">
        <!-- Room Details -->
        <div class="mb-10 lg:mb-0">
            <img src="{{ asset('images/rooms/' . $room->room_type . '.jpg') }}" 
                 alt="{{ $room->room_type }}" 
                 class="w-full h-64 object-cover rounded-lg"
                 onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3'"
            >
            <div class="mt-6">
                <h2 class="text-2xl font-bold text-gray-900">{{ ucwords(str_replace('_', ' ', $room->room_type)) }}</h2>
                <p class="mt-2 text-gray-600">{{ $room->description }}</p>
                <div class="mt-4">
                    <span class="text-2xl font-bold text-blue-600">${{ number_format($room->price_per_night) }}</span>
                    <span class="text-gray-600">/night</span>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Complete Your Booking</h3>
            <form action="{{ route('bookings.store', $room) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <x-date-picker 
                        name="check_in" 
                        label="Check In" 
                        placeholder="Select check-in date"
                        :min-date="date('Y-m-d')"
                        required
                    />
                    @error('check_in')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-date-picker 
                        name="check_out" 
                        label="Check Out" 
                        placeholder="Select check-out date"
                        :min-date="date('Y-m-d', strtotime('+1 day'))"
                        required
                    />
                    @error('check_out')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Number of Guests</label>
                    <input type="number" 
                           name="guests"
                           value="{{ old('guests', 1) }}"
                           min="1"
                           max="{{ $room->max_guests }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           required
                    >
                    @error('guests')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Special Requests</label>
                    <textarea name="special_requests" 
                              rows="3" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Any special requirements or requests?">{{ old('special_requests') }}</textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    Confirm Booking
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 