<?php

namespace App\Livewire\Backend\Donor;

use App\Models\Donor;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonorCreate extends Component
{
    use WithFileUploads;

    public $name;

    public $father_name;

    public $mother_name;

    public $phone;

    public $email;

    public $address;

    public $donation_amount;

    public $photo;

    public $note;

    public function save()
    {
        $data = $this->validate([
            'name' => 'required',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'phone' => 'required',
            'email' => 'nullable',
            'address' => 'nullable',
            'donation_amount' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'note' => 'nullable',
        ]);

        // PHOTO Upload
        if ($this->photo) {
            $fileName = 'donor-'.time().'.'.$this->photo->getClientOriginalExtension();
            $data['photo'] = $this->photo->storeAs('donors/photos', $fileName, 'public');
        }

        Donor::create($data);

        session()->flash('success', 'Donor Created Successfully');

        return redirect()->route('donors.index');
    }

    public function render()
    {
        return view('livewire.backend.donor.donor-create');
    }
}
