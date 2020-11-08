<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['name', 'year', 'synopsis', 'runtime', 'released_at', 'cost', 'created_at', 'updated_at'];
}
