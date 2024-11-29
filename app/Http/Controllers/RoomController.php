<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Amenity;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $amenities = Amenity::all();
        $query = Room::query();

        // Apply price filter
        if ($request->min_price) {
            $query->where('price_per_night', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price_per_night', '<=', $request->max_price);
        }

        // Apply room type filter
        if ($request->room_types) {
            $query->whereIn('room_type', $request->room_types);
        }

        // Apply amenities filter
        if ($request->amenities) {
            $query->whereHas('amenities', function($q) use ($request) {
                $q->whereIn('amenities.id', $request->amenities);
            });
        }

        // Apply sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price_per_night', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_per_night', 'desc');
                break;
            default:
                $query->orderBy('room_id', 'desc');
        }

        $rooms = $query->paginate(9);
        
        // Get unique room types for filter
        $roomTypes = Room::distinct()->pluck('room_type');
        
        return view('rooms.index', compact('rooms', 'roomTypes', 'amenities'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }
}