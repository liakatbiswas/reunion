<?php

namespace App\Livewire\Frontend\Registration;

use App\Mail\RegistrationSuccessfull;
use App\Models\Batch;
use App\Models\District;
use App\Models\Division;
use App\Models\Registration;
use App\Models\Upazila;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationCreate extends Component
{
    use WithFileUploads;

    public $name;

    public $batch_id;

    public $division_id;

    public $district_id;

    public $upazila_id;

    public $village;

    public $post_office;

    public $status = 'pending';

    public $occupation;

    public $phone;

    public $photo;

    public $bKash;

    public $email;

    public $gender;

    public $member_type;

    public $children = 0;

    public $amount = 0;

    public $note;

    public $batches;

    public $divisions;

    public $districts = [];

    public $upazilas = [];

    public function mount()
    {
        $this->batches = Batch::orderBy('name')->get();
        $this->divisions = Division::orderBy('name')->get();
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

    // Auto Calculations
    public function updatedMemberType()
    {
        $this->calculateAmount();
    }

    public function updatedChildren()
    {
        $this->calculateAmount();
    }

    public function calculateAmount()
    {
        switch ($this->member_type) {
            case 'single':
                $this->amount = 2000;
                break;

            case 'couple':
                $this->amount = 3500;
                break;

            case 'parent_with_children':
                $this->amount = 2000 + ($this->children * 1000);
                break;

            case 'couple_with_children':
                $this->amount = 3500 + ($this->children * 1000);
                break;

            case 'children_only':
                $this->amount = $this->children * 1000;
                break;

            default:
                $this->amount = 0;
        }
    }

    // Validation Rules
    protected $rules = [
        'name' => 'required|max:255',
        'batch_id' => 'required|exists:batches,id',

        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',

        'village' => 'required|max:255',
        'post_office' => 'nullable|max:255',

        'occupation' => 'nullable|max:255',
        'phone' => 'required|max:20|unique:registrations,phone',

        'photo' => 'nullable|image|max:2048',

        'bKash' => 'required|max:20',
        'email' => 'nullable|email',

        'gender' => 'required|in:male,female,other',

        'member_type' => 'required|in:single,couple,parent_with_children,couple_with_children,children_only',
        'children' => 'nullable|numeric|min:0',
        'amount' => 'required|numeric|min:0',

        'note' => 'nullable|max:2000',
    ];

    public function submit()
    {
        $validated = $this->validate();

        // ক্রমানুসার ID তৈরি করা
        $last = Registration::latest('id')->first();
        $number = $last ? ((int) substr($last->regi_id, -4)) + 1 : 1;
        $regi_id = 'NJJHS25'.str_pad($number, 4, '0', STR_PAD_LEFT);

        // -----------------------------------
        // Image Upload Fix
        // -----------------------------------
        $path = null;

        if ($this->photo) {
            // $originalName = $this->photo->getClientOriginalName();
            // $fileName = 'user-'.now()->format('YmdHis').'-'.$originalName;
            $fileName = 'user-'.time().'.'.$this->photo->getClientOriginalExtension();
            $path = $this->photo->storeAs('photos', $fileName, 'public');
        }

        // -----------------------------------
        // Save to Database
        // -----------------------------------
        $credentials = Registration::create([
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
            'phone' => $this->phone,
            'photo' => $path, // <-- Fixed
            'bKash' => $this->bKash,
            'email' => $this->email,
            'gender' => $this->gender,
            'member_type' => $this->member_type,
            'children' => $this->children,
            'amount' => $this->amount,
            'note' => $this->note,
        ]);

        flash()->option('timeout', 2000)->success('Registration Completed Successfully!');

        Mail::to('nasirabad.ghschool@gmail.com')->send(new RegistrationSuccessfull($credentials));

        $this->resetExcept(['batches', 'divisions']);

        return redirect()->route('registration.index');
    }

    public function render()
    {
        return view('livewire.frontend.registration.registration-create');
    }
}
