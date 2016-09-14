<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Form_question;
use App\Http\Requests\FormResultRequest;
use App\Form_result;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        
        $fquestions = Form_question::whereHas('group', function ($q) {        
		    $q->where('name', 'like', '%Pendaftaran%');
		})->orderBy('order', 'asc')->get();

        // if (Request::ajax()) {                                            
        //     return view('mms.pendaftaran-content', compact('fquestions'));
        // }
        
		return view('mms.pendaftaran', compact('fquestions'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormResultRequest $request)
    {        
        $input = $request->all();        
        
        $name = $input['id_question_5'];
        $username = $input['id_question_18'];
        $email = $input['id_question_4'];
        $password1 = $input['id_question_19'];
        $password2 = $input['id_question_20'];

        if ($password1 != $password2) {
            return "Password do not match!";
        } else {

            $rules = $this->rules();
                        
            $attributeNames = $this->names();
            
            // Create a new validator instance.
            $validator = Validator::make($input, $rules);
            $validator->setAttributeNames($attributeNames);

            if ($validator->passes()) {

                $user = new User;

                $user->name = $name;
                $user->username = $username;
                $user->email = $email;
                $user->password = $password1;
                $user->role = "0";
                $user->no_kta = "0";
                $user->no_rn = "0";                

                $user->save(); 
                                
            } else {
                return Redirect::to('pendaftaran1')->withErrors($validator);                            
            }
        }            

        $datas = array();
        foreach ($input as $key => $value) {
            $keys = explode("_", $key);
            $form_result = new formResult;

            try {
                if (!empty($keys[2])) {
                    $form_result->id_question = $keys[2];                    
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);
                    } else {
                        $form_result->answer_value = $value;
                    }                    
                    $form_result->id_user = $user->id;

                    $datas[] = $form_result;
                }
            } catch (\ErrorException $e) {
                
            }              
        }
        //$input = $request->get('id_question');
        
        // return $datas;
        foreach ($datas as $data) {
            // $asdad = json_encode($data);
            // return $asdad;
            // Form_result::create($asdad);

            $fr = new Form_result;

            $fr->id_question = $data->id_question;
            $fr->answer_value = $data->answer_value;
            $fr->id_user = !empty($data->id_user) ? $data->id_user : '0';

            $fr->save();                        
        }

        return redirect('/');   
    }

    public function rules() {

        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();

        $rules = [];

        foreach($fquestions as $key => $value) {
            $rules["id_question_{$value->id}"] = 'required';        
        }

        return $rules;
    }

    public function names() {

        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();

        $names = [];

        foreach($fquestions as $key => $value) {                    
            $names["id_question_{$value->id}"] = $value->question;            
        }

        return $names;
    }
}

class formResult {
    public $id_question;
    public $answer_value;
    public $id_user;
}