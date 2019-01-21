<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'slug', 'document', 'document_type_id', 'level', 'user_type', 'status', 'profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function documentType()
    {
        return $this->belongsTo('App\Models\documentType');
    }

    public function employee()
    {
        return $this->hasOne('App\Employee');
    }

    public function eContacts()
    {
        return $this->hasMany('App\EmergencyContact');
    }

    public function Childrens()
    {
        return $this->hasMany('App\Models\Children');
    }

    public function registerpys()
    {
        return $this->hasMany('App\Models\Registerpys');
    }

}
