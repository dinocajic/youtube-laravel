<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiddlewareTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('auth')->except('index');
//        $this->middleware('auth')->only('store');
//        $this->middleware('auth')->only(['create', 'store']);
    }

    public function index()
    {
        return "Middleware Controller";
    }

    public function store(Request $request)
    {
        return "Store some form datar";
    }

    public function create()
    {
        return "Return Form";
    }
}
