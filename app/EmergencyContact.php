<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
	protected $fillable = [
        'user_id','name','phone'
    ];
}
