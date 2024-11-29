@extends('layouts.app')

@section('title', 'Book Room - Harbour')

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
            <div class="mt-6 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ ucwords(str_replace('_', ' ', $room->room_type)) }}</h2>
                    <p class="mt-2 text-gray-600">{{ $room->description }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center bg-gray-50 px-4 py-3 rounded-xl">
                        <svg class="h-5 w-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="text-gray-700">Floor {{ $room->floor_number }}</span>
                    </div>
                    <div class="flex items-center bg-gray-50 px-4 py-3 rounded-xl">
                        <svg class="h-5 w-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-gray-700">Up to {{ $room->max_guests }} guests</span>
                    </div>
                </div>

                <div class="flex items-baseline">
                    <span class="text-3xl font-bold text-blue-600">${{ number_format($room->price_per_night) }}</span>
                    <span class="text-gray-600 ml-2">/night</span>
                </div>

                @if($room->amenities->isNotEmpty())
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Room Amenities</h3>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($room->amenities as $amenity)
                                <div class="flex items-center bg-gray-50 px-4 py-3 rounded-xl">
                                    @if($amenity->icon)
                                        <i class="{{ $amenity->icon }} text-blue-600 mr-3"></i>
                                    @endif
                                    <span class="text-gray-700">{{ $amenity->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
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