<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Exercise;
use App\Models\UserExerciseWordResult;
use App\Models\UserExerciseListResult;
use App\Models\UserExercisePhoneResult;
use App\Models\UserExercisePasswordResult;

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

    public function lists()
    {
        return $this->hasMany(UserExerciseListResult::class);
    }

    public function phones()
    {
        return $this->hasMany(UserExercisePhoneResult::class);
    }

    public function passwords()
    {
        return $this->hasMany(UserExercisePasswordResult::class);
    }


}
