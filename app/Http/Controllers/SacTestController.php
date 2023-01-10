<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SacTestController extends Controller
{
    public function __invoke($name)
    {
        return "I'm being invoked. I know...original: " . $name;
    }
}
