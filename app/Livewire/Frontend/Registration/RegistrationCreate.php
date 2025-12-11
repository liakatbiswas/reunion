<?php

namespace App\Livewire\Frontend\Registration;

use App\Models\Batch;
use App\Models\District;
use App\Models\Division;
use App\Models\Registration;
use App\Models\Upazila;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationCreate extends Component
{
    use WithFileUploads;

    public $name;

    public $batch_id;

    public $division_id = 8;

    public $district_id = 64;

    public $upazila_id = 490;

    public $post_office = 2410;

    public $village;

    public $occupation;

    public $users;

    public $phone;

    public $photo;

    public $bKash;

    public $email;

    public $gender;

    public $amount;

    public $user_id;

    public $note;

    public $batches;

    public $divisions;

    public $districts = [];

    public $upazilas = [];

    public function mount()
    {
        $this->batches = Batch::orderBy('name')->get();
        $this->divisions = Division::orderBy('name')->get();
        $this->users = User::orderBy('name')->get();
        $this->districts = collect();
        $this->upazilas = collect();
    }

    // Cascading Dropdown
    public function updatedDivisionId($value)
    {
        $this->districts = District::where('division_id', $value)->orderBy('name')->get();
        $this->district_id = null;

        $this->upazilas = collect();
        $this->upazila_id = null;
    }

    public function updatedDistrictId($value)
    {
        $this->upazilas = Upazila::where('district_id', $value)->orderBy('name')->get();
        $this->upazila_id = null;
    }

    // Validation Rules
    protected $rules = [
        'name' => 'required|max:255',
        'batch_id' => 'required|exists:batches,id',

        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',

        'village' => 'nullable|max:255',
        'post_office' => 'nullable|max:255',

        'occupation' => 'nullable|max:255',
        'user_id' => 'required|exists:users,id',
        'phone' => 'required|max:20|unique:registrations,phone',

        'photo' => 'nullable|image|max:2048',

        'bKash' => 'nullable|max:20',
        'email' => 'nullable|email',

        'gender' => 'required|in:male,female,other',

        'amount' => 'required|numeric|min:0', // manual amount input

        'note' => 'nullable|max:2000',
    ];

    public function submit()
    {
        $validated = $this->validate();

        // Generate Registration ID
        $last = Registration::latest('id')->first();
        $number = $last ? ((int) substr($last->regi_id, -4)) + 1 : 1;
        $regi_id = 'NJJHS25'.str_pad($number, 4, '0', STR_PAD_LEFT);

        // // Image Upload
        // $path = null;

        // if ($this->photo) {
        //     $fileName = 'user-'.time().'.'.$this->photo->getClientOriginalExtension();
        //     $path = $this->photo->storeAs('photos', $fileName, 'public');
        // }

        // Image Upload
        $path = null;

        if ($this->photo) {
            // File name create
            $fileName = 'user-'.time().'.'.$this->photo->getClientOriginalExtension();
            // Store uploaded photo
            $path = $this->photo->storeAs('photos', $fileName, 'public');
            // Delete Livewire temporary file
            if (file_exists($this->photo->getRealPath())) {
                unlink($this->photo->getRealPath());
            }
        }

        // Save to Database
        Registration::create([
            'name' => $this->name,
            'regi_id' => $regi_id,
            'batch_id' => $this->batch_id,

            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,

            'village' => $this->village,
            'post_office' => $this->post_office,

            'status' => 'pending',
            'occupation' => $this->occupation,
            'user_id' => $this->user_id,
            'phone' => $this->phone,
            'photo' => $path,

            'bKash' => $this->bKash,
            'email' => $this->email,
            'gender' => $this->gender,

            'amount' => $this->amount,

            'note' => $this->note,
        ]);

        flash()->option('timeout', 2000)->success('Registration Completed Successfully!');

        $this->resetExcept(['batches', 'divisions']);

        return redirect()->route('registration.index');
    }

    public function render()
    {
        return view('livewire.frontend.registration.registration-create');
    }
}
