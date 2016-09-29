<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Form_result extends Model
{
    protected  $table = "form_result";

    protected $appends = ['answer_type', 'answer'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_question', 'id_user', 'answer_value', 'trackingcode',
    ];

    /**
     * Get the question record associated with the result.
     */
    public function question()
    {
        return $this->hasOne('App\Form_question', 'id', 'id_question');
    }    

    /**
     * Get the user record associated with the result.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    /**
     * Get the user record associated with the result.
     */
    public function answer()
    {
        return $this->hasOne('App\Form_answer', 'id', 'answer_value');
    }

    public function getAnswerTypeAttribute() 
    {
        $id = $this->attributes['id_question'];        
        $name = Form_question::findOrFail($id)->setting->name;         

        return $name;
    }

    public function getAnswerAttribute() 
    {
        $id = $this->attributes['answer_value'];    

        $request = ['answer_value' => $id];        

        $validator = Validator::make($request, [
            'answer_value' => 'integer',            
        ]);

        if ($validator->passes()) {
            $answers = Form_answer::find($id);
            if ($answers) {
                return $answers->answer;
            }

            return $id;
        }   

        return $id;     
    }
}
