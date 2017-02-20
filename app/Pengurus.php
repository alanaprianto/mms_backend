<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected  $table = "pengurus";

    protected $fillable = [
        'name', 'address', 'position', 'description', 'email'
    ];

    protected $appends = ['pos_name'];

    public function getPosNameAttribute()
    {
        $name = $this->attributes['position'];
        $position = Pjabatan::find($name);
        return $position->title;
    }

}