<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventProject extends Model
{
    use HasFactory;
    protected $table = 'event_project'; // Specify the table name if it differs from the default
// In EventProject.php
public function project()
{
    return $this->belongsTo(Project::class);
}
// In your EventProject model
public function event()
{
    return $this->belongsTo(Event::class, 'event_id');
}

}
