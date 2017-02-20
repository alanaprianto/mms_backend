<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pjabatan extends Model
{
    protected  $table = "pjabatan";

    protected $fillable = [
        'title', 'short_title', 'parent', 'description', 'status'
    ];
}
