<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use Illuminate\Http\Request;
use Log;

class ZohoCallLogController extends Controller
{
    public function store(Request $request) {
        $owner = $request->input('owner');
        $zoho_id = $request->input('id');
        $subject = $request->input('subject');
        $created_time = $request->input('created_time');
        $modified_time = $request->input('modified_time');
        $modified_by = $request->input('modified_by');
        $call_duration_sec = $request->input('call_duration_sec');
        $call_duration = $request->input('call_duration');
        $lead_name = $request->input('lead_name');
        $call_direction = $request->input('call_direction');
        $caller_type = $request->input('caller_type');
        $call_start_time = $request->input('call_start_time');
        $created_by_name = $request->input('created_by_name');
        $modified_by_name = $request->input('modified_by_name');
        $email = $request->input('email');

        CallLog::create([
            'owner' => $owner,
            'zoho_id' => $zoho_id,
            'subject' => $subject,
            'created_time' => $created_time,
            'modified_time' => $modified_time,
            'modified_by' => $modified_by,
            'call_duration_sec' => $call_duration_sec,
            'call_duration' => $call_duration,
            'lead_name' => $lead_name,
            'call_direction' => $call_direction,
            'caller_type' => $caller_type,
            'call_start_time' => $call_start_time,
            'created_by_name' => $created_by_name,
            'modified_by_name' => $modified_by_name,
            'email' => $email,
        ]);
    }
}
