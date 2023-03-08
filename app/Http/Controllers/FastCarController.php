<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
// Test

class FastCarController extends Controller
{
    public function index()
    {
        return view('fastcars.index');
    }

    public function show(Car $car)
    {
        return view ('fastcars.show')->with('fastcar', $car);
    }
}
