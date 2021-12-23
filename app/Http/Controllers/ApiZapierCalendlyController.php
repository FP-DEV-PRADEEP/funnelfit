<?php

namespace App\Http\Controllers;

use App\Models\Calendly;
use App\Models\Prospect;
use Illuminate\Http\Request;

class ApiZapierCalendlyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'mobile' => ['required'],
            'gym' => ['required'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            "start_time" => ['required'],
            "end_time" => ['required'],
            "event_uuid" => ['required'],
            "event_type_uuid" => ['required'],
            "url_slug" => ['required'],
        ]);

        // create prospect
        $prospect = Prospect::create([
            'prospect_email' => $request->input('email'),
            'prospect_mobile' => $request->input('mobile'),
            'prospect_gym' => $request->input('gym'),
            'prospect_first_name' => $request->input('firstname'),
            'prospect_last_name' => $request->input('lastname'),
            'prospect_source' => 'Calendly',
        ]);

        $calendly = Calendly::create([
            "start_time" => $validated['start_time'],
            "end_time" => $validated['end_time'],
            "event_uuid" => $validated['event_uuid'],
            "event_type_uuid" => $validated['event_type_uuid'],
            "url_slug" => $validated['url_slug'],
            "prospect_id" => $prospect->id
        ]);

        return $calendly;
    }
}
