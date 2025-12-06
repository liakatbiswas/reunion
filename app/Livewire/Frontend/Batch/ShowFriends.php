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
        $batch = Batch::with('registrations')->findOrFail($this->batch_id);

        return view('livewire.frontend.batch.show-friends', [
            'batch' => $batch,
            'friends' => $batch->registrations()->latest()->paginate(10),
        ]);
    }
}
