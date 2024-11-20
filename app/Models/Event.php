<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_name',
        'session',
        'start_date',
        'end_date',
        'description',
        'incharge_id',
    ];

    
    public function projects()
    { 
        return $this->belongsToMany(Project::class, 'event_project');
    }

   
    
}
