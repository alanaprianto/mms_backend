<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected  $table = "notifications";
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
}
