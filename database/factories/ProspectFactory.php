<?php

namespace Database\Factories;

use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProspectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prospect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->word(),
            'source' => $this->faker->word(),
            'date' => $this->faker->dateTimeBetween('-1 years', '+2 years'),
        ];
    }
}
