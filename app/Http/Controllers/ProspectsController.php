<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

class ProspectsController extends Controller
{
    public function index() {
        return view('Prospects.index');
    }

    public function getData() {
        return Prospect::filter(Request::only('search', 'date', 'gym'))
            ->paginate(10);
    }

    public function getLocations() {
        return Prospect::groupBy('location')->pluck('location');
    }

    public function getGyms() {
        return Prospect::groupBy('prospect_gym')->pluck('prospect_gym');
    }
}
