<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuizSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'subject_id'
    ];

    public function quizzes()
    {
        return $this->BelongsToMany(Quiz::class, 'quiz_subjects');
    }
}
