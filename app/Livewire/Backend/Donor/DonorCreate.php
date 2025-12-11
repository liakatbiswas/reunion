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

    public $donation_type;

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
            'donation_type' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'note' => 'nullable',
        ]);

        // PHOTO Upload
        if ($this->photo) {

            $fileName = 'donor-'.time().'.'.$this->photo->getClientOriginalExtension();

            // Save to storage
            $data['photo'] = $this->photo->storeAs('uploads/donors', $fileName, 'public');

            // Delete Livewire temporary file
            if (file_exists($this->photo->getRealPath())) {
                unlink($this->photo->getRealPath());
            }
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
