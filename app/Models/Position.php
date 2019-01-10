<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function depend()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public function positions()
    {
        return $this->hasMany('App\Models\Position', 'depend_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Employee');
    }
}
