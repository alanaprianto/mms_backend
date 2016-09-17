<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_type extends Model
{
    protected  $table = "form_type";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'html_tag',        
    ];

    /**
     * Get the question record associated with the setting.
     */
    public function question()
    {
        return $this->hasMany('App\Form_question', 'type');
    }
}
