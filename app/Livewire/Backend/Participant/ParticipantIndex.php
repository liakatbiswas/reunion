<?php

namespace App\Livewire\Backend\Participant;

use App\Exports\ParticipantExport;
use App\Models\Registration;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function exportExcel()
    {
        return Excel::download(new ParticipantExport($this->search), 'participants.xlsx');
    }

    public function render()
    {
        return view('livewire.backend.participant.participant-index', [
            'registrations' => Registration::where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('regi_id', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhereHas('batch', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                })
                ->paginate(10),
        ]);
    }
}
