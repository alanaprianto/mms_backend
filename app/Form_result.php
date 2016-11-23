<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Form_result extends Model
{
    protected  $table = "form_result";

    protected $appends = ['answer_type', 'answer', 'question_group', 'question', 'territory_name'];

    protected $hidden = ['password', 'remember_token'];

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
    // public function question()
    // {
    //     $id = $this->attributes['id_question'];    

    //     $request = ['id_question' => $id];        

    //     $validator = Validator::make($request, [
    //         'id_question' => 'integer',            
    //     ]);

    //     if ($validator->passes()) {
    //         return $this->hasOne('App\Form_question', 'id', 'id_question');            
    //     } else {
    //         return null;
    //     }
    // }    

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

        $request = ['id_question' => $id];        

        $validator = Validator::make($request, [
            'id_question' => 'integer',            
        ]);

        if ($validator->passes()) {
            $name = Form_question::find($id);
            if ($name) {
                return $name->setting->name;
            }

            return null;
        }                    
        return null;
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
            } else {
                $daerah = Daerah::find($id);
                if ($daerah) {
                    return $daerah->daerah;
                } else {
                    $provinsi = Provinsi::find($id);
                    if ($provinsi) {
                        return $provinsi->provinsi;
                    } else {
                        return $id;
                    }
                }
            }

            return $id;
        }   

        return $id;     
    }

    public function getQuestionAttribute() 
    {
        $id = $this->attributes['id_question'];    

        $request = ['id_question' => $id];        

        $validator = Validator::make($request, [
            'id_question' => 'integer',            
        ]);

        if ($validator->passes()) {
            $question = Form_question::find($id);
            if ($question) {
                return $question->question;
            }

            return $id;
        }   

        return $id;     
    }

    public function getQuestionGroupAttribute() 
    {
        $id = $this->attributes['id_question'];    

        $request = ['id_question' => $id];        

        $validator = Validator::make($request, [
            'id_question' => 'integer',            
        ]);

        if ($validator->passes()) {
            $question = Form_question::find($id);
            if ($question) {
                return $question->group->name;
            }

            return null;
        }   

        return null;
    }

    public function getTerritoryNameAttribute()
    {
        $terr = $this->attributes['answer_value'];
        if ($terr) {
            $request = ['id' => $terr];        

            $validator = Validator::make($request, [
                'id' => 'integer',            
            ]);

            if ($validator->passes()) {
                $daerah = Daerah::find($terr);
                if ($daerah) {
                    return $daerah->daerah;
                } else {
                    $provinsi = Provinsi::find($terr);
                    if ($provinsi) {
                        return $provinsi->provinsi;
                    } else {
                        return "Location Not Found";
                    }
                }
            } else {
                return "Location Not Found";
            }            
        }
        return "Location Not Found";
    }
}
