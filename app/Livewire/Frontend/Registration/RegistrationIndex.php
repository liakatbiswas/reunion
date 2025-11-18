<?php

namespace App\Livewire\Frontend\Registration;

use App\Models\Registration;
use Livewire\Component;

class RegistrationIndex extends Component
{
    public function render()
    {
        return view('livewire.frontend.registration.registration-index', [
            'registrations' => Registration::all(),
        ]);
    }
}
