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
        $search = trim($this->search);

        $participants = Registration::query()
            ->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->join('divisions', 'registrations.division_id', '=', 'divisions.id')
            ->join('districts', 'registrations.district_id', '=', 'districts.id')
            ->join('upazilas', 'registrations.upazila_id', '=', 'upazilas.id')
            ->leftJoin('users', 'registrations.user_id', '=', 'users.id')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('registrations.name', 'like', "%{$search}%")
                        ->orWhere('registrations.regi_id', 'like', "%{$search}%")
                        ->orWhere('registrations.email', 'like', "%{$search}%")
                        ->orWhere('registrations.phone', 'like', "%{$search}%")
                        ->orWhere('registrations.bKash', 'like', "%{$search}%")
                        ->orWhere('batches.name', 'like', "%{$search}%")
                        ->orWhere('divisions.name', 'like', "%{$search}%")
                        ->orWhere('districts.name', 'like', "%{$search}%")
                        ->orWhere('upazilas.name', 'like', "%{$search}%")
                        ->orWhere('users.name', 'like', "%{$search}%");
                });
            })
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*')
            ->get();

        $pdf = Pdf::loadView('backend.exports.participants', compact('participants'));

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

    // Toggle status method
    public function toggleStatus($id)
    {
        $reg = Registration::findOrFail($id);

        $reg->status = $reg->status === 'active' ? 'pending' : 'active';
        $reg->save();

        session()->flash('success', 'Status changed to '.ucfirst($reg->status).'!');
    }

    /**
     * Render the component view with paginated and filtered participant data.
     */
    public function render()
    {
        // $registrations = Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
        //     ->when($this->search, function ($q) {
        //         $q->where('name', 'like', "%{$this->search}%")
        //             ->orWhere('email', 'like', "%{$this->search}%")
        //             ->orWhere('regi_id', 'like', "%{$this->search}%")
        //             ->orWhere('phone', 'like', "%{$this->search}%")
        //             ->orWhereHas('batch', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
        //     })
        //     ->join('batches', 'registrations.batch_id', '=', 'batches.id')
        //     ->orderBy('batches.name', 'asc')
        //     ->select('registrations.*')
        //     ->paginate(15);

        // return view('livewire.backend.participant.participant-index', compact('registrations'));

        $search = trim($this->search);

        $registrations = Registration::query()
            ->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->join('divisions', 'registrations.division_id', '=', 'divisions.id')
            ->join('districts', 'registrations.district_id', '=', 'districts.id')
            ->join('upazilas', 'registrations.upazila_id', '=', 'upazilas.id')
            ->leftJoin('users', 'registrations.user_id', '=', 'users.id')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($x) use ($search) {
                    $x->where('registrations.name', 'like', "%{$search}%")
                        ->orWhere('registrations.regi_id', 'like', "%{$search}%")
                        ->orWhere('registrations.email', 'like', "%{$search}%")
                        ->orWhere('registrations.phone', 'like', "%{$search}%")
                        ->orWhere('registrations.bKash', 'like', "%{$search}%")

                        ->orWhere('batches.name', 'like', "%{$search}%")
                        ->orWhere('divisions.name', 'like', "%{$search}%")
                        ->orWhere('districts.name', 'like', "%{$search}%")
                        ->orWhere('upazilas.name', 'like', "%{$search}%")
                        ->orWhere('users.name', 'like', "%{$search}%");
                });
            })
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*')
            ->paginate(15);

        return view('livewire.backend.participant.participant-index', compact('registrations'));

    }
}
