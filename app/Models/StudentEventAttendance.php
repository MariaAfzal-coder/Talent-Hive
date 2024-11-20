<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEventAttendance extends Model
{
    use HasFactory;

      // Define the table name if it does not follow Laravel's naming convention
      protected $table = 'students_events_attendance';

      // Define the fillable fields to allow mass assignment
      protected $fillable = [
          'event_id',
          'student_id',
          'incharge_id',
          'status',
          'created_at',
      ];
  
      // Disable timestamps if not using them
      public $timestamps = false;
  
      /**
       * Relationships
       */
  
      // Each attendance record belongs to one event
      public function event()
      {
          return $this->belongsTo(Event::class, 'event_id');
      }
  
      // Each attendance record belongs to one student
      public function student()
      {
          return $this->belongsTo(Student::class, 'student_id');
      }
  
      // Each attendance record is managed by one incharge
      public function incharge()
      {
          return $this->belongsTo(Incharge::class, 'incharge_id');
      }
}
