<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name', 'bio', 'born_at', 'created_at', 'updated_at'];
}
