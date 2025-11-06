<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserExerciseResult;
use App\Models\UserExerciseWordResult;
use App\Models\UserExerciseListResult;
use App\Models\UserExercisePhoneResult;

class Exercise extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'type',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];


    public function results(){
        return $this->hasMany(UserExerciseResult::class);
    }

    public function wordResults(){
        return $this->hasMany(UserExerciseWordResult::class);
    }

    public function listResults(){
        return $this->hasMany(UserExerciseListResult::class);
    }

    public function phoneResults(){
        return $this->hasMany(UserExercisePhoneResult::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
