<?php

namespace Database\Factories;

use App\Models\Calendly;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendlyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calendly::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');

        return [
            'start_time' => $start,
            'end_time' => $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days'),
            'event_uuid' => $this->faker->uuid,
            'event_type_uuid' => $this->faker->uuid,
            'url_slug' => $this->faker->slug(),
            'prospect_id' => Prospect::factory(),
        ];
    }
}
