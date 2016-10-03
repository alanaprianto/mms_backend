<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    protected  $table = "daerah";    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'daerah', 'description',
    ];  
}
