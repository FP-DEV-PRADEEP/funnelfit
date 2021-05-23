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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
            'date' => 'required|date',
        ]);

        $carbonDate = new Carbon(Request::input('date'));

        $prospect = Prospect::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'date' => $carbonDate,
        ]);

        return $prospect->id;
    }
}
