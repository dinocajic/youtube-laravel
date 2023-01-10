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

    public function edit($id)
    {
        return "If we were editing, this would be for " . $id;
    }

    public function delete($user_id, $user_name)
    {
        return "Record " . $user_id . " has been deleted for " . $user_name;
    }
}
