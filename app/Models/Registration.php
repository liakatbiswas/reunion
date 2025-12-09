<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'regi_id',
        'batch_id',
        'division_id',
        'district_id',
        'upazila_id',
        'user_id',
        'village',
        'post_office',
        'status',
        'occupation',
        'phone',
        'photo',
        'bKash',
        'email',
        'gender',
        'amount',
        'note',
    ];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
