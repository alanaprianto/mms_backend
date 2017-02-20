<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected  $table = "role";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent', 'name', 'keterangan',
    ];    

    /**
     * Get the user record associated with the role.
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
