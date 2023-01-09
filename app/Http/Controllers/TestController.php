<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return [
            [
                "make" => "Chevrolet",
                "model" => "Corvette",
            ],
            [
                "make" => "Porsche",
                "model" => "911 GT3",
            ],
        ];
    }

    public function show()
    {
        return [
            "make" => "Porsche",
            "model" => "911 GT3",
        ];
    }
}
