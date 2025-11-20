<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    protected $fillable = ['name', 'batch_id', 'division_id', 'district_id', 'upazila_id', 'village', 'occupation', 'phone', 'bKash', 'email', 'gender', 'member_type', 'children', 'amount'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
