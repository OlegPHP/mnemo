<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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


    public function users(){
        return $this->belongsToMany(User::class, 'user_exercise_results')
            ->withPivot('score', 'comment', 'completed_at')
            ->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
