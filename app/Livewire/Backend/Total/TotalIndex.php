<?php

namespace App\Livewire\Backend\Total;

use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TotalIndex extends Component
{
    public function render()
    {

        return view('livewire.backend.total.total-index', [
            // মোট amount
            'totalAmount' => Registration::sum('amount'),

            // ৮০০ টাকা
            'eightHundredCount' => Registration::where('amount', 800)->count(),
            'eightHundredTotal' => Registration::where('amount', 800)->sum('amount'),

            // ১০০০ টাকা
            'thousandCount' => Registration::where('amount', 1000)->count(),
            'thousandTotal' => Registration::where('amount', 1000)->sum('amount'),

            // সব amount গ্রুপ করে
            'grouped' => Registration::select(
                'amount',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(amount) as total')
            )
                ->groupBy('amount')
                ->orderBy('amount')
                ->get(),
        ]);
    }
}
