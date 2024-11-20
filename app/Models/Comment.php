<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


public function project()
{
    return $this->belongsTo(Project::class, 'project_id');
}

public function company()
{
    return $this->belongsTo(Company::class, 'company_id');
}


protected $fillable = ['project_id', 'company_id', 'comment'];

}
