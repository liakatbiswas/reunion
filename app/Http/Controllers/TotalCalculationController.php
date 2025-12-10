<?php

namespace App\Http\Controllers;

class TotalCalculationController extends Controller
{
    public function total()
    {
        return view('backend.total.index');
    }

    public function show800()
    {
        return view('backend.total.eight');
    }

    public function show1000()
    {
        return view('backend.total.thousand');
    }
}
