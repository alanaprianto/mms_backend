<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected  $table = "gallery";    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'created_by',
        'filename',
        'size',
    ];

    /**
     * Get the user record associated with the gallery.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}
