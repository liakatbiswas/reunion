<?php

namespace App\Livewire\Backend\Participant;

use App\Models\Batch;
use App\Models\District;
use App\Models\Division;
use App\Models\Registration;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ParticipantEdit extends Component
{
    use WithFileUploads;

    public $participant_id;

    public $name;

    public $batch_id;

    public $amount;

    public $phone;

    public $bKash;

    public $email;

    public $occupation;

    public $user_id;

    public $division_id;

    public $district_id;

    public $upazila_id;

    public $village;

    public $post_office;

    public $gender;

    public $note;

    public $photo;

    public $new_photo;

    public function mount($id)
    {
        $this->participant_id = $id;

        $p = Registration::findOrFail($id);

        $this->name = $p->name;
        $this->batch_id = $p->batch_id;
        $this->amount = $p->amount;
        $this->phone = $p->phone;
        $this->bKash = $p->bKash;
        $this->email = $p->email;
        $this->occupation = $p->occupation;
        $this->user_id = $p->user_id;
        $this->division_id = $p->division_id;
        $this->district_id = $p->district_id;
        $this->upazila_id = $p->upazila_id;
        $this->village = $p->village;
        $this->post_office = $p->post_office;
        $this->gender = $p->gender;
        $this->note = $p->note;
        $this->photo = $p->photo;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'batch_id' => 'required',
            'phone' => 'required',
            'amount' => 'required|numeric|min:800|max:1000',
            'gender' => 'required',
        ]);

        $p = Registration::findOrFail($this->participant_id);

        // Handle new photo upload
        if ($this->new_photo) {
            // Delete old photo
            if ($p->photo && Storage::disk('public')->exists($p->photo)) {
                Storage::disk('public')->delete($p->photo);
            }
            // Store new photo
            $fileName = time().'.'.$this->new_photo->getClientOriginalExtension();
            $this->new_photo->storeAs('uploads/participants', $fileName, 'public');
            $p->photo = 'uploads/participants/'.$fileName;
            // Delete Livewire temporary file
            if (file_exists($this->new_photo->getRealPath())) {
                unlink($this->new_photo->getRealPath());
            }
        }

        $p->update([
            'name' => $this->name,
            'batch_id' => $this->batch_id,
            'amount' => $this->amount,
            'phone' => $this->phone,
            'bKash' => $this->bKash,
            'email' => $this->email,
            'occupation' => $this->occupation,
            'user_id' => $this->user_id,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'village' => $this->village,
            'post_office' => $this->post_office,
            'gender' => $this->gender,
            'note' => $this->note,
        ]);

        session()->flash('success', 'Participant updated successfully.');

        return redirect()->route('participants.index');
    }

    public function render()
    {
        return view('livewire.backend.participant.participant-edit', [
            'batches' => Batch::all(),
            'users' => User::all(),
            'divisions' => Division::all(),
            'districts' => District::where('division_id', $this->division_id)->get(),
            'upazilas' => Upazila::where('district_id', $this->district_id)->get(),
        ]);
    }
}
