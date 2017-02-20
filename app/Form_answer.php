<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_answer extends Model
{
	protected  $table = "form_answer";

    protected $appends = ['options_tag'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer', 'description', 'question_id', 'options_type',
    ];

    /**
     * Get the question record associated with the answer.
     */
    public function question()
    {
        return $this->belongsTo('App\Form_question', 'question_id', 'id');
    }

    /**
     * Get the question record associated with the answer.
     */
    public function opt_type()
    {
        return $this->hasOne('App\Form_setting', 'id', 'options_type');
    }

    public function getOptionsTagAttribute() 
    {
        $id = $this->attributes['options_type'];        
        $options_tag = Form_setting::findOrFail($id)->html_tag; 
        // $options = Form_setting::findOrFail($id); 

        return $options_tag;
    }
}
