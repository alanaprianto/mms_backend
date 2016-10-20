<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Daerah;
use App\Provinsi;

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

    protected $appends = ['territory_name', 'trackingcode'];

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

    public function kta()
    {
        return $this->hasOne('App\Kta', 'owner', 'id');
    }
    
    public function getTerritoryNameAttribute()
    {
        $terr = $this->attributes['territory'];
        if ($terr) {
            $daerah = Daerah::find($terr);
            if ($daerah) {
                return $daerah->daerah;
            } else {
                $provinsi = Provinsi::find($terr);
                if ($provinsi) {
                    return $provinsi->provinsi;
                } else {
                    return "Location Not Found";
                }
            }
        }
        return "Location Not Found";
    }

    public function getTrackingcodeAttribute()
    {        
        $id = $this->attributes['id'];        
        $code = Form_result::where('id_user', '=', $id)->first();
        if ($code) {
            return $code->trackingcode;;
        } else {
            return null;
        }        
    }
}
