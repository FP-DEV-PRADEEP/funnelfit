<?php

namespace App\Console\Commands;

use App\Models\TextLog;
use App\Service\JustCallService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendPendingProspectSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'funnlefit:send-pending-proposal-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send pending proposal sms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(JustCallService $service)
    {
        $timezone = 'America/Los_Angeles';
        $today_9am = Carbon::parse('today 9am', $timezone);
        $today_7pm = Carbon::parse('today 7pm', $timezone);
        $now = Carbon::now($timezone);
        $send = $now->gte($today_9am) && $now->lte($today_7pm);

        // check can we send message now
        if($send) {
            foreach (TextLog::where('status', '0')->cursor() as $text_log) {
                $service->sendSMS($text_log->to, $text_log->message);
                $text_log->update([
                    'status' => 1
                ]);
            }
        }
    }
}
