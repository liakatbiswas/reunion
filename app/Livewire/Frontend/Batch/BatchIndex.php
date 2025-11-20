<?php

namespace App\Livewire\Frontend\Batch;

use App\Models\Batch;
use Livewire\Component;

class BatchIndex extends Component
{
    public function render()
    {
        return view('livewire.frontend.batch.batch-index', [
            'batches' => Batch::orderBy('name', 'ASC')->get(),
        ]);
    }
}
