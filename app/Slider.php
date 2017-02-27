<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected  $table = "slider";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img', 'title', 'link',
    ];

    protected $appends = ['slider_url', 'slider_thmb_url'];

    public function getSliderUrlAttribute() 
    {
        $img = $this->attributes['img'];    

        $url = url('images/slider/')."/".$img;
        return $url;
    }

    public function getSliderThmbUrlAttribute() 
    {
        $img = $this->attributes['img'];    

        $url = url('images/slider/thumbnail')."/".$img;
        return $url;
    }
}
