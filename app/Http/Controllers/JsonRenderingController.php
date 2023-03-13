<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class JsonRenderingController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return view('json-rendering.index')->with('cars', $cars);
    }
}
