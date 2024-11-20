<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'student_id',   // Relationship to the students table
        'title',
        'status',
        'image',
        'ending_date',
        'abstract',
        'members',
        'languages',
        'supervised_by',
        'video_url',
    ];

    // Define relationship to Student model
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_project');
    }

    public function students()
{
    return $this->belongsToMany(Student::class, 'project_members', 'project_id', 'student_id');
}
public function supervisor()
{
    return $this->belongsTo(Supervisor::class, 'supervised_by');
}

public function comments()
    {
        return $this->hasMany(Comment::class, 'project_id');
    }

}
