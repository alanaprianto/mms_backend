<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_question extends Model
{
	protected  $table = "form_question";

    protected $appends = ['setting', 'list_answer', 'group_name', 'question_type', 'rules_detail',];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'group_question', 'answer_type', 'description', 'order', 'type', 'rules',
    ];

    /**
     * Get the group record associated with the question.
     */
    public function group()
    {
        return $this->belongsTo('App\Form_question_group', 'group_question', 'id');
    }

    /**
     * Get the setting record associated with the question.
     */
    public function setting()
    {
        return $this->belongsTo('App\Form_setting', 'answer_type', 'id');
    }

    /**
     * Get the type record associated with the question.
     */
    public function qtype()
    {
        return $this->belongsTo('App\Form_type', 'type', 'id');
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

    /**
     * Get the setting record associated with the question.
     */
    public function rules()
    {
        return $this->belongsToMany('App\Form_setting', 'rules', 'id');
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
        $answers = Form_answer::where('question_id', '=', $id)->orderBy('id', 'asc')->get();        
        
        return $answers;
    }

    public function getGroupNameAttribute() 
    {
        $id = $this->attributes['group_question'];
        $group = Form_question_group::findOrFail($id);

        return $group->name;
    }

    public function getQuestionTypeAttribute()
    {
        // return $this->attributes['writing'] == 'yes';        

        $id = $this->attributes['type'];        
        $type = Form_type::findOrFail($id);        
        
        return $type;
    }

    public function getRulesDetailAttribute() 
    {
        $string = $this->attributes['rules'];    
        $ids = explode(", ", $string);

        $errors = array_filter($ids);

        if (empty($errors)) {
            return null;
        }
        $rules = Form_rules::whereIn('id', $ids)->get();        
        
        return $rules;
    }    
}
