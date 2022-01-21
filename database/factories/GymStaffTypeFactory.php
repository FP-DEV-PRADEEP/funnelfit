<?php

namespace Database\Factories;

use App\Models\GymStaffType;
use Illuminate\Database\Eloquent\Factories\Factory;

class GymStaffTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GymStaffType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word()
        ];
    }
}
