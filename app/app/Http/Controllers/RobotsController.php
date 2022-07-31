<?php

namespace App\Http\Controllers;

class RobotsController extends Controller
{
    public function index()
    {
        return response()->view("robots", [
            "url" => url("/"),
        ])->header("Content-Type", "text/plain");
    }
}
