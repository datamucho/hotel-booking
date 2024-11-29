<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $roomTypes = ['Single', 'Double', 'Suite'];
        $statuses = ['Available', 'Occupied', 'Maintenance'];

        $amenityIds = Amenity::pluck('id')->toArray();

        for ($i = 0; $i < 15; $i++) {
            $room = Room::create([
                'room_type' => $faker->randomElement($roomTypes),
                'description' => $faker->paragraph(2),
                'price_per_night' => $faker->randomFloat(2, 50, 500),
                'availability_status' => $faker->randomElement($statuses),
                'floor_number' => $faker->numberBetween(1, 5),
                'max_guests' => $faker->numberBetween(1, 4),
            ]);

            $randomAmenityIds = $faker->randomElements(
                $amenityIds, 
                $faker->numberBetween(3, 5)
            );
            
            $room->amenities()->attach($randomAmenityIds);
        }
    }
}