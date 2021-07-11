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
            'prospect_owner' => $this->faker->word(),
            'prospect_id' => $this->faker->word(),
            'modified_by' => $this->faker->word(),
            'prospect_phone' => $this->faker->phoneNumber(),
            'prospect_email' => $this->faker->word(),
            'prospect_mobile' => $this->faker->phoneNumber(),
            'prospect_gym' => $this->faker->word(),
            'prospect_city' => $this->faker->city,
            'prospect_state' => $this->faker->state,
            'created_by_name' => $this->faker->name(),
            'modified_by_name' => $this->faker->name(),
            'prospect_first_name' => $this->faker->firstName(),
            'prospect_last_name' => $this->faker->lastName(),
            'prospect_source' => $this->faker->word(),
            'date' => $this->faker->dateTimeBetween('-1 years', '+2 years'),
        ];
    }
}
