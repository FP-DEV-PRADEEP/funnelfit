<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadSearchController extends Controller
{
    public function index(Request $request)
    {
        return view('lead-search');
    }
}
