<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // generate gym location
        \App\Models\GymLocation::factory()
            ->count(10)
            ->create();

        // // Generate Gym staff type
        \App\Models\GymStaffType::factory()
            ->count(10)
            ->create();

        // // Generate gymstaff
        \App\Models\GymStaff::factory()
            ->count(20)
            ->sequence(fn () => ['gym_staff_type_id' => \App\Models\GymStaffType::all()->random(), 'gym_location_id' => \App\Models\GymLocation::all()->random()])
            ->create();

        // Generate calendly data
        \App\Models\Calendly::factory()
            ->count(100)
            ->sequence(fn () => ['event_uuid' => \App\Models\GymStaff::all()->random()->event_uuid])
            ->create();
    }
}
