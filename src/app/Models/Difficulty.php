<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    use HasFactory;


    protected $fillable = [
        'level'
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'quiz_difficulties');
    }
}
