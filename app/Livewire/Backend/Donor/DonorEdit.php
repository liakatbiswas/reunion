<?php

namespace App\Livewire\Backend\Donor;

use App\Models\Donor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonorEdit extends Component
{
    use WithFileUploads;

    public $donor;

    public $name;

    public $father_name;

    public $mother_name;

    public $phone;

    public $email;

    public $address;

    public $donation_amount;

    public $donation_type;

    public $note;

    public $photo; // new uploaded photo

    public $old_photo; // existing saved photo

    public function mount($id)
    {
        $this->donor = Donor::findOrFail($id);

        $this->name = $this->donor->name;
        $this->father_name = $this->donor->father_name;
        $this->mother_name = $this->donor->mother_name;
        $this->phone = $this->donor->phone;
        $this->email = $this->donor->email;
        $this->address = $this->donor->address;
        $this->donation_amount = $this->donor->donation_amount;
        $this->donation_type = $this->donor->donation_type;
        $this->note = $this->donor->note;
        $this->old_photo = $this->donor->photo;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'donation_amount' => 'required|numeric|min:1',
            'donation_type' => 'required',
            'note' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'donation_amount' => $this->donation_amount,
            'donation_type' => $this->donation_type,
            'note' => $this->note,
        ];

        // If new photo uploaded
        if ($this->photo) {

            // Delete old photo
            if ($this->donor->photo && Storage::disk('public')->exists($this->donor->photo)) {
                Storage::disk('public')->delete($this->donor->photo);
            }

            // New file name
            $fileName = 'donor-'.time().'.'.$this->photo->getClientOriginalExtension();

            // Store new photo
            $data['photo'] = $this->photo->storeAs('uploads/donors', $fileName, 'public');

            // Delete Livewire temporary file
            if (file_exists($this->photo->getRealPath())) {
                unlink($this->photo->getRealPath());
            }
        }

        // Update DB record
        $this->donor->update($data);

        session()->flash('success', 'Donor updated successfully.');

        return redirect()->route('donors.index');
    }

    public function render()
    {
        return view('livewire.backend.donor.donor-edit');
    }
}
