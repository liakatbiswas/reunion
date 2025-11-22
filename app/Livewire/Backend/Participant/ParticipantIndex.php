<?php

namespace App\Livewire\Backend\Participant;

use App\Exports\ParticipantExport;
use App\Exports\ParticipantsWordExport;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantIndex extends Component
{
    use WithPagination;

    // Search keyword for filtering participants
    public $search = '';

    /**
     * Reset pagination whenever the search term is updated.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Export the filtered participant list to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new ParticipantExport($this->search), 'participants.xlsx');
    }

    /**
     * Export the filtered participant list to PDF.
     */
    public function exportPDF()
    {
        // Fetch participants based on search query
        $participants = Registration::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->get();

        // Load PDF view with participants
        $pdf = Pdf::loadView('backend.exports.participants', compact('participants'));

        // Stream the PDF file for download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'participants.pdf');
    }

    /**
     * Export the filtered participant list to Word document.
     */
    public function exportWord()
    {
        // Create new Word export instance with search filter
        $export = new ParticipantsWordExport($this->search);

        // Download Word file
        return $export->download();
    }

    /**
     * Render the component view with paginated and filtered participant data.
     */
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
