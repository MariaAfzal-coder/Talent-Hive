<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;
    protected $table = 'cvs'; // Explicitly set the correct table name

    protected $fillable = [
        'student_id', // Add this line to allow mass assignment
        'image',
        'name',
        'profile',
        'phone',
        'email',
        'address',
        'additional_info',
        'education',
        'skills',
        'languages',
        'work_experience',
    ];
}
