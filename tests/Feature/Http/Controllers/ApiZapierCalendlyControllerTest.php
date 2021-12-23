<?php

namespace Tests\Feature\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiZapierCalendlyControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_creates_calendly_entry_in_database()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/api/import-calendly', [
            'email' => $this->faker->email,
            'mobile' => $this->faker->phoneNumber,
            'gym' => $this->faker->word(),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName,
            'start_time' => Carbon::createFromTimestamp($this->faker->dateTime()->getTimestamp())->toDateTimeString(),
            'end_time' => Carbon::createFromTimestamp($this->faker->dateTime()->getTimestamp())->toDateTimeString(),
            'event_uuid' => $this->faker->uuid,
            'event_type_uuid' => $this->faker->uuid,
            'url_slug' => $this->faker->slug(),
        ]);

        $response->assertStatus(201);
    }
}
