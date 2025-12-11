<?php

namespace App\Livewire\Frontend\Donor;

use App\Models\Donor;
use Livewire\Component;
use Livewire\WithPagination;

class DonerIndex extends Component
{
    use WithPagination;

    public $search;

    public $perPage = 20;

    public function updatingSearch()
    {
        $this->resetPage();
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
            ->orderBy('donation_amount', 'desc')
            ->paginate($this->perPage);

        return view('livewire.frontend.donor.doner-index', compact('donors'));
    }
}
