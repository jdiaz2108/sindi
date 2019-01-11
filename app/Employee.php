<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = "user_id";
    public    $incrementing = false;
    protected $fillable = [
        'id', 'user_id',
        'user_picture','cellphone_personal','phone_personal','adress_personal','departament_adress_id','city_adress_id','hobbies','mental_rest','position_id','departament_id','city_id','salary','cellphone_corporate', 'email_corporate','Bogota_bank_account_id','secment_id','academic_level_id','studing','profession_id','civil_status_id','birthdate','status_id','eps_id','afp_id','ccf_id','arl',
    ];
	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function eps()
    {
        return $this->belongsTo('App\Models\Eps');
    }

    public function ccf()
    {
        return $this->belongsTo('App\Models\Ccf');
    }

    public function afp()
    {
        return $this->belongsTo('App\Models\Afp');
    }

    public function arl()
    {
        return $this->belongsTo('App\Models\Arl');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public function profession()
    {
        return $this->belongsTo('App\Models\Profession');
    }

}
