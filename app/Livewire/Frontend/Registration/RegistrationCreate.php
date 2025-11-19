<?php

namespace App\Livewire\Frontend\Registration;

use App\Models\Batch;
use App\Models\Registration;
use Livewire\Component;

class RegistrationCreate extends Component
{
    public $name;

    public $batch_id;

    public $address;

    public $occupation;

    public $phone;

    public $bKash;

    public $email;

    public $amount = 0;

    public $gender;

    public $member_type;

    public $children = 0;

    // Auto calculate
    public function updatedMemberType()
    {
        $this->calculateAmount();
    }

    public function updatedChildren()
    {
        $this->calculateAmount();
    }

    public function calculateAmount()
    {
        switch ($this->member_type) {
            case 'single':
                $this->amount = 2000;
                break;

            case 'couple':
                $this->amount = 3500;
                break;

            case 'parent_with_children':
                $this->amount = 2000 + $this->children * 1000;
                break;

            case 'couple_with_children':
                $this->amount = 3500 + $this->children * 1000;
                break;

            case 'children_only':
                $this->amount = $this->children * 1000;
                break;

            default:
                $this->amount = 0;
        }
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'batch_id' => 'required|exists:batches,id',
        'address' => 'nullable|string|max:500',
        'occupation' => 'nullable|string|max:255',
        'phone' => 'required|string|max:20',
        'bKash' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',

        'member_type' => 'required|in:single,couple,parent_with_children,couple_with_children,children_only',
        'children' => 'nullable|numeric|min:0',
        'amount' => 'required|numeric|min:0',
        'gender' => 'required|in:male,female,other',
    ];

    public function submit()
    {
        $validated = $this->validate();

        Registration::create($validated);

        //   Registration::create([
        //     'name' => $this->name,
        //     'batch_id' => $this->batch_id,
        //     'address' => $this->address,
        //     'occupation' => $this->occupation,
        //     'phone' => $this->phone,
        //     'bKash' => $this->bKash,
        //     'email' => $this->email,
        //     'gender' => $this->gender,
        //     'member_type' => $this->member_type,
        //     'amount' => $this->amount ?? 0,
        // ]);

        flash()->option('timeout', 2000)->success('Registration Completed Successfully!');

        $this->reset();

        return redirect()->route('registration.index');
    }

    public function render()
    {
        return view('livewire.frontend.registration.registration-create', [
            'batches' => Batch::orderBy('id', 'desc')->get(),
        ]);
    }
}
