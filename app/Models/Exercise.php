<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserExerciseResult;
use App\Models\UserExerciseWordResult;

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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
