<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mfront extends Model
{
    protected  $table = "mfrontend";

    protected $fillable = [
        'type', 'cat_id', 'name', 'position', 'description'
    ];
}
