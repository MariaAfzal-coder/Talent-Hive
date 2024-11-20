<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'biography',
        'password',
        'phone_number',
        'profile_image',
        'education',
        'experience',
        'awards_courses',
        'additional_details', // Add this line
    ];
}
