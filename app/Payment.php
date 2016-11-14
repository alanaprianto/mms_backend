<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected  $table = "payment";    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'attempt', 'amount', 'payment_date', 'trackingcode'
    ];

    /**
     * Get the payment record associated with the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
