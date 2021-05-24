<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // To Not Actually Removed from Database
    use SoftDeletes;

    // Validate Fill Data
    protected $fillable = [
        'user_id',
        'category_name',
    ];

    // JOIN DATA Table User and Category with ORM
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
