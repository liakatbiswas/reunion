<?php

namespace App\Livewire\Frontend\Registration;

use App\Models\Registration;
use Livewire\Component;

class RegistrationCreate extends Component
{
    public $name;

    public $batch;

    public $address;

    public $occupation;

    public $phone;

    public $email;

    public $member;

    public $amount;

    public $gender;

    protected $rules = [
        'name' => 'required|string|max:255',
        'batch' => 'required|string|max:50',
        'address' => 'nullable|string|max:500',
        'occupation' => 'nullable|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'member' => 'required|numeric',
        'amount' => 'required|numeric|min:0',
        'gender' => 'required|in:male,female,other',
    ];

    public function submit()
    {
        $validated = $this->validate();

        Registration::create($validated);

        flash()->option('timeout', 2000)->success('Registration Completed Successfully!');

        $this->reset();

        return redirect()->route('registration.index');
    }

    public function render()
    {
        return view('livewire.frontend.registration.registration-create');
    }
}
