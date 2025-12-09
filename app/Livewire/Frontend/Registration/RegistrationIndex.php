<?php

namespace App\Livewire\Frontend\Registration;

use App\Models\Registration;
use Livewire\Component;
use Livewire\WithPagination;

class RegistrationIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.frontend.registration.registration-index', [
            'registrations' => Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
                ->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('regi_id', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('bKash', 'like', "%{$this->search}%");
                })
                ->latest()
                ->paginate(10),
        ]);
    }
}
