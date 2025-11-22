<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    /** @use HasFactory<\Database\Factories\DivisionFactory> */
    use HasFactory;

    protected $fillable = ['name', 'bn_name', 'url'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
