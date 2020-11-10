<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use PrimaryAsUuid;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name'];

    /**
     * The movies that belongs to this genre.
     */
    public function movies()
    {
        return $this->hasMany('App\Models\Movie');
    }
}
