<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStudentChat extends Model
{
    use HasFactory;
    protected $table = 'company_students_chat'; // specify the table name if not following Laravel conventions

    use HasFactory;

 
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'created_at',
        'updated_at'
    ];

    // Define relationships for sender (Company)
    public function companySender()
    {
        return $this->belongsTo(Company::class, 'sender_id');
    }

    // Define relationships for receiver (Student)
    public function studentReceiver()
    {
        return $this->belongsTo(Student::class, 'receiver_id');
    }

    // Define relationships for sender (Student)
    public function studentSender()
    {
        return $this->belongsTo(Student::class, 'sender_id');
    }
// In CompanyStudentChat model
public function companyReceiver()
{
    return $this->belongsTo(Company::class, 'receiver_id'); // Adjust accordingly
}

 
   
}
