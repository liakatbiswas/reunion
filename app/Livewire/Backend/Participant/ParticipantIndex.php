<?php

namespace App\Livewire\Backend\Participant;

use App\Models\Registration;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantIndex extends Component
{
    public $search = '';

    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.backend.participant.participant-index', [
            'registrations' => Registration::where('name', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->paginate(10),
        ]);
    }
}
