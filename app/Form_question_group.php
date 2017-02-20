<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_question_group extends Model
{
    protected  $table = "form_question_group";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',        
    ];

    /**
     * Get the question record associated with the group.
     */
    public function question()
    {
        return $this->hasMany('App\Form_question');
    }
}
