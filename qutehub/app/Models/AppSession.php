<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSession extends Model
{
    use HasFactory;

    protected $table = 'app_sessions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'started_at',
        'ended_at',
        'correct_questions',
        'assessment_id',
        'user_id',
    ];

    // Relationships
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
