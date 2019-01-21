<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conceptpys extends Model
{
    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }
}
