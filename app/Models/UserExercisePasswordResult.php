<?php

namespace App\Models;

use App\Models\Exercise;
use App\Models\User;
use App\Models\UserExerciseResult;
use Illuminate\Database\Eloquent\Model;


class UserExercisePasswordResult extends Model
{
    protected $fillable = [
        'user_id',
        'exercise_id',
        'user_exercise_result_id',
        'position',
        'password',
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
