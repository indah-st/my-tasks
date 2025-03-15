<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    // Aktifkan SoftDeletes
    use SoftDeletes;

    // Kolom yang dapat diisi
    protected $fillable = ['title', 'description', 'completed', 'due_date', 'image'];

    // Kolom yang harus dianggap sebagai tanggal oleh Eloquent
    protected $dates = ['deleted_at'];
}