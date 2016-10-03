<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    protected  $table = "notifications";

    protected $appends = ['crt_human'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target', 'sender', 'value', 'active',
    ];

    /**
     * Get the user record associated with the notif.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'target', 'id');
    }

    public function getCrtHumanAttribute()
    {
        $crtat = $this->attributes['created_at'];

        return Carbon::createFromFormat('Y-m-d H:i:s', $crtat)->diffForHumans();        
    }
}
