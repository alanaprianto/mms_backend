<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Form_answer;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role', 'no_kta', 'no_rn', 'password_confirmation', 'territory',
    ];

    protected $appends = ['territory_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the result record associated with the user.
     */
    public function result()
    {
        return $this->hasMany('App\Form_result', 'id', 'id_user');
    }

    /**
     * Get the role record associated with the user.
     */
    public function myrole()
    {
        return $this->belongsTo('App\Role', 'role', 'id');
    }

    /**
     * Get the notif record associated with the user.
     */
    public function notif()
    {
        return $this->hasMany('App\Role', 'id', 'target');
    }

    public function getTerritoryNameAttribute()
    {
        $terr = $this->attributes['territory'];        
        if ($terr) {
            return Form_answer::find($terr)->answer;
        }
        return "Location Not Found";
    }
}
