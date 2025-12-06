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
        $batch = Batch::with('registrations')->find($this->batch_id);

        if (! $batch) {
            return view('livewire.frontend.batch.show-friends', [
                'batch' => null,
                'friends' => collect(), // empty collection
            ]);
        }

        return view('livewire.frontend.batch.show-friends', [
            'batch' => $batch,
            'friends' => $batch->registrations()->orderBy('name', 'ASC')->get(),
        ]);
    }
}
