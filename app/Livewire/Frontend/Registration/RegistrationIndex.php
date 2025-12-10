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

        $registrations = Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
            ->when($this->search, function ($q) {
                $search = $this->search;
                $q->where('registrations.name', 'like', "%{$search}%") // Explicitly qualify
                    ->orWhere('registrations.email', 'like', "%{$search}%")
                    ->orWhere('registrations.regi_id', 'like', "%{$search}%")
                    ->orWhere('registrations.phone', 'like', "%{$search}%")
                    ->orWhereHas('batch', fn ($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*')
            ->paginate(15);

        return view('livewire.frontend.registration.registration-index', compact('registrations'));
    }
}
