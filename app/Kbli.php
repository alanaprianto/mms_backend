<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kbli extends Model
{
    protected  $table = "kbli";

    public $incrementing = false;

    protected $appends = ['limited_name'];

    protected $fillable = [
        'id', 'name', 'type', 'parent'
    ];

    public function getLimitedNameAttribute()
    {        
        $name = $this->attributes['name'];        
        return str_limit($name, 60);    
    }
}
