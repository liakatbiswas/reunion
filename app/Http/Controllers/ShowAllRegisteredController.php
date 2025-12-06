<?php

namespace App\Http\Controllers;

class ShowAllRegisteredController extends Controller
{
    public function index($id)
    {
        return view('batch.show-friends', compact('id'));
    }
}
