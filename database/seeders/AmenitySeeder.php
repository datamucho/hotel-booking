<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            [
                'name' => 'Ocean View',
                'icon' => 'fas fa-water',
                'description' => 'Room with a beautiful ocean view'
            ],
            [
                'name' => 'Balcony',
                'icon' => 'fas fa-door-open',
                'description' => 'Private balcony space'
            ],
            [
                'name' => 'Mini Bar',
                'icon' => 'fas fa-glass-martini',
                'description' => 'Fully stocked mini bar'
            ],
            [
                'name' => 'Room Service',
                'icon' => 'fas fa-concierge-bell',
                'description' => '24/7 room service available'
            ],
            [
                'name' => 'Free WiFi',
                'icon' => 'fas fa-wifi',
                'description' => 'High-speed internet access'
            ],
            [
                'name' => 'Smart TV',
                'icon' => 'fas fa-tv',
                'description' => 'Smart TV with streaming services'
            ],
            [
                'name' => 'Air Conditioning',
                'icon' => 'fas fa-snowflake',
                'description' => 'Climate control system'
            ],
            [
                'name' => 'Safe',
                'icon' => 'fas fa-vault',
                'description' => 'In-room safety deposit box'
            ]
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}