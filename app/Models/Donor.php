<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    /** @use HasFactory<\Database\Factories\DonorFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'phone',
        'email',
        'address',
        'donation_amount',
        'donation_type',
        'photo',
        'note',
    ];
}
