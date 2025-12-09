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
        // return view('livewire.frontend.registration.registration-index', [
        //     'registrations' => Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
        //         ->where(function ($query) {
        //             $query->where('name', 'like', "%{$this->search}%")
        //                 ->orWhere('regi_id', 'like', "%{$this->search}%")
        //                 ->orWhere('phone', 'like', "%{$this->search}%")
        //                 ->orWhere('bKash', 'like', "%{$this->search}%");
        //         })
        //         ->latest()
        //         ->paginate(10),
        // ]);

        $registrations = Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('regi_id', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%")
                    ->orWhereHas('batch', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
            })
            ->join('batches', 'registrations.batch_id', '=', 'batches.id') // join for ordering
            ->orderBy('batches.name', 'asc')                               // order by batch name
            ->select('registrations.*')                                    // select only registrations columns
            ->paginate(15);                                                // adjust pagination as needed

        return view('livewire.frontend.registration.registration-index', compact('registrations'));
    }
}
