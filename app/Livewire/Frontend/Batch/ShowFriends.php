<?php

namespace App\Livewire\Frontend\Batch;

use App\Models\Batch;
use Livewire\Component;

class ShowFriends extends Component
{
    public $batch_id;

    public function mount($id)
    {
        $this->batch_id = $id;
    }

    public function render()
    {

        $batch = Batch::find($this->batch_id);

        $friends = \App\Models\Registration::with([
            'batch',
            'division',
            'district',
            'upazila',
        ])
            ->where('batch_id', $this->batch_id)
            ->orderBy('name', 'ASC')
            ->get();

        return view('livewire.frontend.batch.show-friends', compact('batch', 'friends'));
    }
}
