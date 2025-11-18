<?php

namespace App\Http\Controllers;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('registration.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registration.create');
    }
}
