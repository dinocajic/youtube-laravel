<?php

namespace App\Http\Controllers;

use App\Services\CapitalizeStringService;
use Illuminate\Http\Request;

class AnotherDependencyInjectionController extends Controller
{
    private CapitalizeStringService $capitalizeStringService;

    public function __construct(CapitalizeStringService $capitalizeStringService)
    {
        $this->capitalizeStringService = $capitalizeStringService;
    }

    public function index(Request $request, )
    {
        $upper = $this->capitalizeStringService->capitalize( $request->input('name') );

        return $upper;
    }
}
