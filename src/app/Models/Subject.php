<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject'
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_subjects', 'subject_id', 'quiz_id');
    }

}
