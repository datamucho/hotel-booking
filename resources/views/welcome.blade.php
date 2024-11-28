@extends('layouts.app')

@section('title', 'Welcome to Harbour')

@section('content')
    <!-- Hero Section with Image Background -->
    <div class="relative h-screen">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                 alt="Luxury Hotel" 
                 class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex flex-col justify-center h-full">
                <div class="animate-fade-in space-y-6">
                    <h1 class="text-5xl md:text-7xl font-bold text-white max-w-3xl">
                        Discover Luxury in Every Stay
                    </h1>
                    <p class="text-xl text-gray-200 max-w-2xl">
                        Experience world-class hospitality with breathtaking views and unparalleled comfort.
                    </p>
                </div>
                
                <!-- Search Component -->
                <form action="{{ route('rooms.index') }}" method="GET" class="mt-10 bg-white/95 backdrop-blur-lg rounded-2xl shadow-xl p-6 max-w-4xl transform transition-all duration-300 hover:scale-[1.02]">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <x-date-picker 
                                name="check_in" 
                                label="Check In" 
                                placeholder="Select check-in date"
                                :min-date="date('Y-m-d')"
                                required
                            />
                        </div>
                        <div class="space-y-2">
                            <x-date-picker 
                                name="check_out" 
                                label="Check Out" 
                                placeholder="Select check-out date"
                                :min-date="date('Y-m-d', strtotime('+1 day'))"
                                required
                            />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Guests</label>
                            <div class="relative">
                                <select name="guests" 
                                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 appearance-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                                    @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
                                    @endfor
                                </select>
                                <button type="submit" 
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 transition-colors">
                                    <span class="hidden md:block mr-2">Search</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Why Choose Harbour</h2>
                <p class="mt-4 text-xl text-gray-600">Experience the perfect blend of luxury and comfort</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Feature cards with hover effects -->
                <div class="group p-8 rounded-2xl transition-all duration-300 hover:bg-blue-50 hover:shadow-xl">
                    <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-blue-600 text-white group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="mt-8 text-xl font-semibold text-gray-900">Premium Locations</h3>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Carefully selected properties in the most desirable locations worldwide.
                    </p>
                </div>

                <div class="group p-8 rounded-2xl transition-all duration-300 hover:bg-blue-50 hover:shadow-xl">
                    <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-blue-600 text-white group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="mt-8 text-xl font-semibold text-gray-900">Luxury Service</h3>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        24/7 concierge service and personalized attention to every detail of your stay.
                    </p>
                </div>

                <div class="group p-8 rounded-2xl transition-all duration-300 hover:bg-blue-50 hover:shadow-xl">
                    <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-blue-600 text-white group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-8 text-xl font-semibold text-gray-900">Best Price Guarantee</h3>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Competitive rates and exclusive deals for our valued guests.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Rooms Section -->
    <div class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Popular Rooms</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-room :room="[
                    'title' => 'Deluxe Ocean Suite',
                    'description' => 'Breathtaking ocean views with premium amenities',
                    'price' => 499,
                    'imageUrl' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3'
                ]" :isShowcase="true" />

                <x-room :room="[
                    'title' => 'Presidential Suite',
                    'description' => 'Ultimate luxury with panoramic city views',
                    'price' => 899,
                    'imageUrl' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3'
                ]" :isShowcase="true" />

                <x-room :room="[
                    'title' => 'Garden Villa',
                    'description' => 'Private sanctuary with exclusive garden access',
                    'price' => 699,
                    'imageUrl' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3'
                ]" :isShowcase="true" />
            </div>
        </div>
    </div>
@endsection