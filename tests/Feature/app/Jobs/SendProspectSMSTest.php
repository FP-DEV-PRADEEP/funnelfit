<?php

namespace Tests\Feature\app\Jobs;

use App\Jobs\SendProspectSMS;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SendProspectSMSTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_send_sms_to_prospect()
    {
        Bus::fake();
        $this->withoutExceptionHandling();
        $timezone = 'America/Los_Angeles';
        $travel_time = Carbon::parse('today 2pm', $timezone);
        $this->travelTo($travel_time);
        $prospect = Prospect::factory()->create();
        $this->app->make(SendProspectSMS::class, ['prospect' => $prospect])->handle();
        $prospect->refresh();
        $this->assertEquals(0, $prospect->text_logs->count());
    }

    public function test_it_put_prospect_sms_to_pending()
    {
        $this->withoutExceptionHandling();
        $timezone = 'America/Los_Angeles';
        $travel_time = Carbon::parse('today 4am', $timezone);
        $this->travelTo($travel_time);
        $prospect = Prospect::factory()->create();
        $job = $this->app->make(SendProspectSMS::class, ['prospect' => $prospect])->handle();
        $prospect->refresh();
        $this->assertEquals(1, $prospect->text_logs->count());
    }
}
