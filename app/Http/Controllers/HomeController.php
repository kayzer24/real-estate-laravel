<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index():View
    {
        $properties = Property::with('pictures')->available(true)->recent()->limit(4)->get();

        return view('home', [
            'properties' => $properties
        ]);
    }
}
