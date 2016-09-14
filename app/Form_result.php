<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_result extends Model
{
    protected  $table = "form_result";

    protected $appends = ['answer_type'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_question', 'id_user', 'answer_value',
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

    public function getAnswerTypeAttribute() 
    {
        $id = $this->attributes['id_question'];        
        $name = Form_question::findOrFail($id)->type->name;         

        return $name;
    }
}
