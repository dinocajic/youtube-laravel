<?php

namespace App\Http\Controllers;

use App\Services\CapitalizeStringService;
use Illuminate\Http\Request;

class DependencyInjectionTestController extends Controller
{
    public function index(Request $request, CapitalizeStringService $capitalizeStringService)
    {
        $upper = $capitalizeStringService->capitalize( $request->input('name') );

        return $upper;
    }

    public function test()
    {
        $request = app()->make(Request::class);
        $capitalizeStringService = app()->make(CapitalizeStringService::class);

        $upper = $capitalizeStringService->capitalize( $request->input('name') );

        return $upper;
    }
}
