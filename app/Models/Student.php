<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'password', 'sapid', 'name', 'phone', 'cgpa', 'sdp', 'department', 'profile_image',
        'certification_status', 'certification_image' // Add these columns here
    ];


  
public function projects()
{
    return $this->belongsToMany(Project::class, 'project_members', 'student_id', 'project_id');
}
public function cv()
    {
        return $this->hasOne(CV::class, 'student_id'); // Assuming student_id is the foreign key in the cvs table
    }

    public function event()
{
    return $this->belongsTo(Event::class);
}

}
