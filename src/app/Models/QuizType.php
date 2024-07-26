<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    
    public function quizzes()
    {
        return $this->hasMany(Quiz::class); 
    }

}
