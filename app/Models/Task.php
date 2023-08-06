<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = ['name', 'project_id', 'priority', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
