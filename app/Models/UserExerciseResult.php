<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Exercise;
use App\Models\UserExerciseWordResult;

class UserExerciseResult extends Model
{
    protected $fillable = [
        'user_id',
        'exercise_id',
        'score',
        'comment',
        'completed_at',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function words()
    {
        return $this->hasMany(UserExerciseWordResult::class);
    }


}
