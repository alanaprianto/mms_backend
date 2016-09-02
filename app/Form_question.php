<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_question extends Model
{
	protected  $table = "form_question";

    protected $appends = ['setting', 'list_answer',];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'group_question', 'answer_type', 'description',        
    ];

    /**
     * Get the group record associated with the question.
     */
    public function group()
    {
        return $this->belongsTo('App\Form_question_group', 'group_question', 'id');
    }

    /**
     * Get the type record associated with the question.
     */
    public function type()
    {
        return $this->belongsTo('App\Form_setting', 'answer_type', 'id');
    }

    /**
     * Get the answer record associated with the question.
     */
    public function answer()
    {
        return $this->hasMany('App\Form_answer', 'question_id', 'id');
    }

    /**
     * Get the result record associated with the question.
     */
    public function result()
    {
        return $this->hasMany('App\Form_result', 'id_question', 'id');
    }

    public function getSettingAttribute()
    {
        // return $this->attributes['writing'] == 'yes';        

        $id = $this->attributes['answer_type'];        
        $answer_type = Form_setting::findOrFail($id);        
        
        return $answer_type;
    }

    public function getListAnswerAttribute() 
    {
        $id = $this->attributes['id'];        
        $answers = Form_answer::where('question_id', '=', $id)->get();        
        
        return $answers;
    }
}
