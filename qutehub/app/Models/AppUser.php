<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'app_users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'creator_id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id');
    }
}