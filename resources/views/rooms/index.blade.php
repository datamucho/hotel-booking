@extends('layouts.app')

@section('title', 'Available Rooms')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6">Available Rooms</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($rooms as $room)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold mb-2">Room {{ $room->room_id }}</h2>
                            <p class="text-gray-600">Type: {{ $room->room_type }}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-sm 
                            @if($room->availability_status == 'Available')
                                bg-green-100 text-green-800
                            @elseif($room->availability_status == 'Occupied')
                                bg-red-100 text-red-800
                            @else
                                bg-yellow-100 text-yellow-800
                            @endif
                        ">
                            {{ $room->availability_status }}
                        </span>
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-gray-600">Floor: {{ $room->floor_number }}</p>
                        <p class="text-lg font-bold text-blue-600 mt-2">${{ number_format($room->price_per_night, 2) }} / night</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 