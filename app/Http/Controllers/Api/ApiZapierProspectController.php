<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class ApiZapierProspectController extends Controller
{
    public function store() {
        $validatedData = Request::validate([
            "owner" => "",
            "prospect_id" => "",
            "modified_by" => "",
            "prospect_phone" => "",
            "prospect_email" => "",
            "prospect_mobile" => "",
            "prospect_gym" => "",
            "prospect_city" => "",
            "prospect_state" => "",
            "created_by_name" => "",
            "modified_by_name" => "",
            "prospect_first_name" => "",
            "prospect_last_name" => "",
            "prospect_source" => "",
        ]);

        $carbonDate = new Carbon(Request::input('date'));

        $prospect = Prospect::create([
            'date' => $carbonDate,
            "prospect_owner" => isset($validatedData['owner']) && !empty($validatedData['owner']) ? $validatedData['owner'] : null,
            "prospect_id" => isset($validatedData['prospect_id']) && !empty($validatedData['prospect_id']) ? $validatedData['prospect_id'] : null,
            "modified_by" => isset($validatedData['modified_by']) && !empty($validatedData['modified_by']) ? $validatedData['modified_by'] : null,
            "prospect_phone" => isset($validatedData['prospect_phone']) && !empty($validatedData['prospect_phone']) ? $validatedData['prospect_phone'] : null,
            "prospect_email" => isset($validatedData['prospect_email']) && !empty($validatedData['prospect_email']) ? $validatedData['prospect_email'] : null,
            "prospect_mobile" => isset($validatedData['prospect_mobile']) && !empty($validatedData['prospect_mobile']) ? $validatedData['prospect_mobile'] : null,
            "prospect_gym" => isset($validatedData['prospect_gym']) && !empty($validatedData['prospect_gym']) ? $validatedData['prospect_gym'] : null,
            "prospect_city" => isset($validatedData['prospect_city']) && !empty($validatedData['prospect_city']) ? $validatedData['prospect_city'] : null,
            "prospect_state" => isset($validatedData['prospect_state']) && !empty($validatedData['prospect_state']) ? $validatedData['prospect_state'] : null,
            "created_by_name" => isset($validatedData['created_by_name']) && !empty($validatedData['created_by_name']) ? $validatedData['created_by_name'] : null,
            "modified_by_name" => isset($validatedData['modified_by_name']) && !empty($validatedData['modified_by_name']) ? $validatedData['modified_by_name'] : null,
            "prospect_first_name" => isset($validatedData['prospect_first_name']) && !empty($validatedData['prospect_first_name']) ? $validatedData['prospect_first_name'] : null,
            "prospect_last_name" => isset($validatedData['prospect_last_name']) && !empty($validatedData['prospect_last_name']) ? $validatedData['prospect_last_name'] : null,
            "prospect_source" => isset($validatedData['prospect_source']) && !empty($validatedData['prospect_source']) ? $validatedData['prospect_source'] : null,
        ]);

        return $prospect->id;
    }
}
