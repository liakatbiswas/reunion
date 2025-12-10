<?php

namespace App\Livewire\Backend\Total;

use App\Models\Registration;
use Livewire\Component;

class Total800 extends Component
{
    public $registrations;

    public function mount()
    {
        // ৮০০ টাকা দেওয়াদের ডেটা লোড
        $this->registrations = Registration::where('amount', 800)->orderBy('batch_id', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.backend.total.total800');
    }
}
