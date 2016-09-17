<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_rules extends Model
{
    protected  $table = "form_rules";    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'parameter', 'description',
    ];

    /**
     * Get the question record associated with the rules.
     */
    public function question()
    {
        return $this->belongsToMany('App\Form_question', 'rules');
    }
}
