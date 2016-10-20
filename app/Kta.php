<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kta extends Model
{
    protected  $table = "kta";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner', 'kta', 'requested_at', 'granted_at',
    ];

    /**
    * Additional fields to treat as Carbon instances.
    *
    * @var array
    */
    protected $dates = ['requested_at'];
    
    /**
     * Get the kta record associated with the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'owner', 'id');
    }
}
