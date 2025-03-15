<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'task_id', 'action', 'created_at'
    ];

    // Relasi ke Task (misalnya, jika TaskHistory berhubungan dengan Task)
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
