<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
