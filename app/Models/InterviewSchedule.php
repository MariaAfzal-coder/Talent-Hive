<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewSchedule extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_id',
        'student_id',
        'date',
        'time',
        'venue',
        'status'
    ];

    // Define relationships if necessary
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
