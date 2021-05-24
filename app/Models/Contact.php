<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Validate Fill Data
    protected $fillable = [
        'address',
        'email',
        'phone',
    ];
}
