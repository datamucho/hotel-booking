<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('customers')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'age' => $faker->numberBetween(18, 80),
                'location' => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}