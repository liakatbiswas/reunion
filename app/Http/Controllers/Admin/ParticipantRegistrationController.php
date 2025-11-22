<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ParticipantRegistrationController extends Controller
{
    public function index()
    {
        return view('backend.participant.index');
    }
}
