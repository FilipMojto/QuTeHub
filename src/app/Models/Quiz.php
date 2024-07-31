<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'time',
        'user_id',
        'description',
        'quiz_type_id',
        'difficulty_id'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'quiz_subjects', 'quiz_id', 'subject_id');  
    }

    public function questions()
    {
        #
        return $this->hasMany(Question::class);
    }


    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class, 'difficulties');
    }

    public function type(){
        return $this->belongsTo(QuizType::class, 'quiz_types');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
