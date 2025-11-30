<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'title_en',
        'description',
        'study_type',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
