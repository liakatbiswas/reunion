<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    /** @use HasFactory<\Database\Factories\UpazilaFactory> */
    use HasFactory;

    protected $fillable = ['district_id', 'name', 'bn_name', 'url'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
