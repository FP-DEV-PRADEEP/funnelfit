<?php

namespace App\Jobs;

use App\Models\Prospect;
use App\Service\JustCallService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendProspectSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Prospect $prospect;
    private JustCallService $service;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($prospect)
    {
        $this->prospect = $prospect;
        $this->service = new JustCallService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $timezone = 'America/Los_Angeles';
        $today_9am = Carbon::parse('today 9am', $timezone);
        $today_7pm = Carbon::parse('today 7pm', $timezone);
        $now = Carbon::now($timezone);
        $send_now = $now->gte($today_9am) && $now->lte($today_7pm);
        $message = "Prospect Created";

        // send sms now
        if($send_now) {
            $this->service->sendSMS($this->prospect->prospect_phone, $message);
        }

        // put sms to sending to wait for next day 9am
        if(!$send_now) {
            $this->prospect->text_logs()->create([
                'to' => $this->prospect->prospect_phone,
                'message' => $message,
            ]);
        }
    }
}
