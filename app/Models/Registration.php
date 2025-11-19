<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    protected $fillable = ['name', 'batch_id', 'address', 'occupation', 'phone', 'bKash', 'email', 'gender', 'member_type', 'children', 'amount'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
