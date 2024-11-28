@props([
    'room',
    'showBookButton' => true,
    'isShowcase' => false
])

<div class="bg-white rounded-xl shadow-sm overflow-hidden transform transition-all duration-300 hover:scale-[1.02] w-full max-w-sm mx-auto h-full flex flex-col">
    <div class="relative">
        <img src="{{ $isShowcase ? ($room['imageUrl'] ?? '') : asset('images/rooms/' . $room->room_type . '.jpg') }}" 
             alt="{{ $isShowcase ? ($room['title'] ?? 'Room') : $room->room_type }}" 
             class="w-full h-52 object-cover"
             onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3'"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
    </div>

    <div class="p-6 flex-1 flex flex-col">
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-900 mb-2">
                {{ $isShowcase ? $room['title'] : ucwords(str_replace('_', ' ', $room->room_type)) }}
            </h3>
            <p class="text-gray-600 line-clamp-2 text-sm">
                {{ $isShowcase ? $room['description'] : $room->description }}
            </p>
        </div>

        <div class="pt-4 border-t border-gray-100 mt-auto">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <span class="text-2xl font-bold text-blue-600">
                        ${{ number_format($isShowcase ? $room['price'] : $room->price_per_night, 0) }}
                    </span>
                    <span class="text-gray-500 text-xs">per night</span>
                </div>
                
                @if($showBookButton)
                    <a href="{{ $isShowcase ? '#' : route('bookings.create', $room) }}" 
                       class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
                        <span class="font-medium">Book Now</span>
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>