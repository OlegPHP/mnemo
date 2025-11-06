<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Exercise;
use App\Models\UserExerciseResult;

class UserExercisePhoneResult extends Model
{
    protected $fillable = [
        'user_id',
        'exercise_id',
        'user_exercise_result_id',
        'position',
        'number',
        'answer',
        'correct_answer',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userExercise()
    {
        return $this->belongsTo(UserExerciseResult::class);
    }
}
