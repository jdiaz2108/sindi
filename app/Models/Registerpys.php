<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registerpys extends Model
{
	protected $fillable = [
         'user_id', 'conceptpys_id' ,'status', 'discount', 'sign', 'signer', 'observations' , 'slug'
    ];

    public function concept()
    {
        return $this->belongsTo('App\Models\Conceptpys', 'conceptpys_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
