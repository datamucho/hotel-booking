<?php

namespace Database\Seeders;

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

        for ($i = 0; $i < 15; $i++) {
            DB::table('rooms')->insert([
                'room_type' => $faker->randomElement($roomTypes),
                'price_per_night' => $faker->randomFloat(2, 50, 500),
                'availability_status' => $faker->randomElement($statuses),
                'floor_number' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}