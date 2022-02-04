<?php

namespace Tests\Feature\app\Console\Commads;

use App\Jobs\SendProspectSMS;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SendPendingProspectSMSTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_send_pending_prospect_sms()
    {
        $this->withoutExceptionHandling();
        Bus::fake();
        $timezone = 'America/Los_Angeles';
        $today_2am = Carbon::parse('today 2am', $timezone);
        $today_9am = Carbon::parse('today 9am', $timezone);

        $this->travelTo($today_2am);
        $prospect = Prospect::factory()->create();

        // test it doesnt send sms instantly
        Bus::assertDispatched(SendProspectSMS::class);
        $this->app->make(SendProspectSMS::class, ['prospect' => $prospect])->handle();
        $prospect->refresh();
        $this->assertEquals(1, $prospect->text_logs()->where('status', 0)->count());

        // test command should not send sms at 2am
        $this->artisan('funnlefit:send-pending-proposal-sms');
        $prospect->refresh();
        $this->assertEquals(1, $prospect->text_logs()->where('status', 0)->count());

        // travel to 9am
        $this->travelTo($today_9am);

        // test command should send sms at 9am
        $this->artisan('funnlefit:send-pending-proposal-sms');
        $prospect->refresh();
        $this->assertEquals(0, $prospect->text_logs()->where('status', 0)->count());
    }
}
