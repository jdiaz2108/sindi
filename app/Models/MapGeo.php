<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapGeo extends Model
{
    protected $fillable = [
        'user_id', 'place_id', 'latitude', 'longitude'
    ];
}
