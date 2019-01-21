<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registerpys extends Model
{
    public function concept()
    {
        return $this->belongsTo('App\Models\Conceptpys', 'conceptpys_id');
    }
}
