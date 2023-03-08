<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
//    public function index()
//    {
//        return [
//            [
//                "make" => "Chevrolet",
//                "model" => "Corvette",
//            ],
//            [
//                "make" => "Porsche",
//                "model" => "911 GT3",
//            ],
//        ];
//    }

//    public function edit($id)
//    {
//        return "If we were editing, this would be for " . $id;
//    }
//
//    public function delete($user_id, $user_name)
//    {
//        return "Record " . $user_id . " has been deleted for " . $user_name;
//    }

//    public function show()
//    {
//        return [
//            "make" => "Porsche",
//            "model" => "911 GT3",
//        ];
//    }

    public function index()
    {
        return Test::all();
    }

    public function show($id)
    {
        return Test::find($id);
    }

    public function store()
    {
        $test = new Test;

        $test->first_name = "Dino";
        $test->last_name = "Cajic";
        $test->phone = "4443335555";
        $test->email = "dino+" . time() . "@example.com";
        $test->bio = "This is the story of Dino";
        $test->age = 102;
        $test->money = 100;
        $test->is_active = true;

        $test->save();

        return $test;
    }

    public function update($id)
    {
        $test = Test::find($id);
        $test->phone = "5554443333";
        $test->save();

        return $test;
    }

    public function destroy($id)
    {
        Test::destroy($id);

        return $id . " has been deleted";
    }
}
