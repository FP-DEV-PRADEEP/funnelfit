<?php

namespace Database\Factories;

use App\Models\GymLocation;
use App\Models\GymStaff;
use App\Models\GymStaffType;
use Illuminate\Database\Eloquent\Factories\Factory;

class GymStaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GymStaff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'event_uuid' => $this->faker->uuid(),
            'clubready_owner_id' => $this->faker->randomDigit(),
            'gym_staff_type_id' => GymStaffType::factory(),
            'gym_location_id' => GymLocation::factory(),
        ];
    }
}
