<?php

namespace App\Livewire\Backend\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminIndex extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind'; // Tailwind pagination

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.backend.admin.admin-index', compact('users'));
    }
}
