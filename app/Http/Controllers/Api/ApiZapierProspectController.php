<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Illuminate\Support\Facades\Request;

class ApiZapierProspectController extends Controller
{
    public function store() {
        $validatedData = Request::validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
            'date' => 'required',
        ]);

        $prospect = Prospect::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'date' => $validatedData['date'],
        ]);

        return $prospect->id;
    }
}
