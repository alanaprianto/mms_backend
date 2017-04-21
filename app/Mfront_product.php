<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mfront_product extends Model
{
    protected  $table = "mfront_products";

    protected $fillable = [
        'type', 'id_mfront', 'id_product', 'title',
    ];
}
