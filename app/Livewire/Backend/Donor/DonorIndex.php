<?php

namespace App\Livewire\Backend\Donor;

use App\Models\Donor;
use Livewire\Component;
use Livewire\WithPagination;

class DonorIndex extends Component
{
    use WithPagination;

    public $search;

    public $perPage = 20;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Donor::find($id)?->delete();
        session()->flash('success', 'Donor deleted successfully!');
    }

    public function render()
    {
        $search = trim($this->search);

        $donors = Donor::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.backend.donor.donor-index', compact('donors'));
    }
}
