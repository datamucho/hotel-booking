@extends('layouts.app')

@section('title', 'Our Rooms - LuxStay')

@section('content')
    <!-- Hero Section -->
    <div class="relative py-16 bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3" 
                 alt="Rooms Header" 
                 class="w-full h-full object-cover opacity-30"
            >
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white mb-4">Our Luxurious Rooms</h1>
            <p class="text-xl text-gray-300">Find your perfect stay among our carefully curated selection</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('rooms.index') }}" method="GET" class="lg:grid lg:grid-cols-12 lg:gap-8">
            <!-- Filters Sidebar -->
            <div class="hidden lg:block lg:col-span-3">
                <div class="sticky top-6 space-y-8">
                    <!-- Price Range Filter -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Price Range</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-600">Minimum Price</label>
                                <input type="number" 
                                       name="min_price"
                                       value="{{ request('min_price') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="$0"
                                >
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Maximum Price</label>
                                <input type="number" 
                                       name="max_price"
                                       value="{{ request('max_price') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="$1000"
                                >
                            </div>
                            <button type="submit" 
                                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                Apply Filter
                            </button>
                        </div>
                    </div>

                    <!-- Room Type Filter -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Room Type</h3>
                        <div class="space-y-3">
                            @foreach($roomTypes as $type)
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="room_types[]" 
                                           value="{{ $type }}"
                                           {{ in_array($type, request('room_types', [])) ? 'checked' : '' }}
                                           class="rounded text-blue-600 focus:ring-blue-500"
                                           onchange="this.form.submit()">
                                    <span class="ml-2 text-gray-700">{{ ucwords(str_replace('_', ' ', $type)) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Amenities Filter -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Amenities</h3>
                        <div class="space-y-3">
                            @foreach(['ocean_view', 'balcony', 'private_pool', 'spa_bath'] as $amenity)
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="amenities[]" 
                                           value="{{ $amenity }}"
                                           {{ in_array($amenity, request('amenities', [])) ? 'checked' : '' }}
                                           class="rounded text-blue-600 focus:ring-blue-500"
                                           onchange="this.form.submit()">
                                    <span class="ml-2 text-gray-700">{{ ucwords(str_replace('_', ' ', $amenity)) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    @if(request()->anyFilled(['min_price', 'max_price', 'room_types', 'amenities']))
                        <div class="mt-4">
                            <a href="{{ route('rooms.index') }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Clear all filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rooms Grid -->
            <div class="mt-6 lg:mt-0 lg:col-span-9">
                <!-- Sort Options -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold text-gray-900">Available Rooms</h2>
                    </div>
                    <div class="ml-4">
                        <select name="sort" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                onchange="this.form.submit()">
                            <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Sort by: Recommended</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <!-- Room Cards Grid -->
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($rooms as $room)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="relative">
                                <img src="{{ asset('images/rooms/' . $room->room_type . '.jpg') }}" 
                                     alt="{{ $room->room_type }}" 
                                     class="w-full h-48 object-cover"
                                     onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3'"
                                >
                                <div class="absolute top-4 right-4 {{ $room->availability_status ? 'bg-white text-blue-600' : 'bg-red-100 text-red-600' }} px-2 py-1 rounded-lg text-sm font-semibold">
                                    {{ $room->availability_status ? 'Available' : 'Booked' }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900">{{ ucwords(str_replace('_', ' ', $room->room_type)) }}</h3>
                                <div class="mt-2 flex items-center text-sm text-gray-600">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Floor {{ $room->floor_number }}
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-blue-600">${{ number_format($room->price_per_night) }}</span>
                                        <span class="text-gray-600">/night</span>
                                    </div>
                                    @if($room->availability_status)
                                        <button 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Book Now
                                        </button>
                                    @else
                                        <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-400 cursor-not-allowed">
                                            Not Available
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <h3 class="text-lg font-medium text-gray-900">No rooms available at the moment</h3>
                            <p class="mt-2 text-gray-600">Please try adjusting your filters or check back later.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $rooms->withQueryString()->links() }}
                </div>
            </div>
        </form>
    </div>
@endsection 
