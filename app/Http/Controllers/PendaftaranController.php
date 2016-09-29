<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Form_question;
use App\Http\Requests\FormResultRequest;
use App\Form_result;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use GuzzleHttp\Exception\RequestException;

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
        
		return view('mms.pendaftaran-content', compact('fquestions'));
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
        // return $input;
        // $name = $input['name'];
        // $username = $input['username'];
        // $email = $input['email'];
        // $password1 = $input['password'];
        // $password2 = $input['password_confirmation'];

        // if ($password1 != $password2) {
        //     return Redirect::to('register1')
        //             ->withErrors(['message' => 'Password is not match!'])
        //             ->withInput(Input::except(['id_question_19', 'id_question_20']));
        // } else {

            
        // }            

        $rules = $this->rules();
        
            $attributeNames = $this->names();
            
            // Create a new validator instance.
            $validator = Validator::make($input, $rules);
            $validator->setAttributeNames($attributeNames);

            if ($validator->passes()) {

                $random_string = md5(microtime());
                $first = substr($random_string, 0, 4);
                $last = substr($random_string, -4);
                $code = $first.$last;                                                        

                $admins = User::where('role', '=', '1')->get();
                $data = array();
                foreach ($admins as $key => $admin) {
                    $notif = new Notification;

                    $notif->target = $admin->id;
                    $notif->sendercode = $code;
                    $notif->value = "New submitted form";
                    $notif->active = true;
                    
                    $notif->save();
                }

            } else {                
                return Redirect::to('register1')
                    ->withInput(Input::except(['password', 'password_confirmation']))
                    ->withErrors($validator);
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
                        if (str_contains($value, '@')) {
                            $email = $value;
                        }
                    }                    
                    $form_result->trackingcode = $code;

                    $datas[] = $form_result;
                }
            } catch (\ErrorException $e) {
                
            }              
        }
        //$input = $request->get('id_question');
        
        // return $email;
        foreach ($datas as $data) {
            // $asdad = json_encode($data);
            // return $asdad;
            // Form_result::create($asdad);

            $fr = new Form_result;

            $fr->id_question = $data->id_question;
            $fr->answer_value = $data->answer_value;
            $fr->id_user = !empty($data->id_user) ? $data->id_user : '0';
            $fr->trackingcode = $code;

            $fr->save();                        
        }

        Mail::send('emails.trackingcode', ['code' => $code], function($message) use ($email) {
            $message->to($email)->subject('Kadin Registration');
        });

        return redirect('/register1success'); 
    }

    public function rules() {

        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();

        $rules = [];
        
        foreach($fquestions as $key => $value) {     
            $type = $value->qtype->name;       
            $params = $value->rules_detail;
            $parameter = [];
            if (!empty($params)) {
                foreach($params as $key => $param) {     
                    $parameter[] = $param->parameter;
                }   
            }            
            if (str_contains($type, "Username")) {
                $rules["username"] = implode("|", $parameter);
            } else if (str_contains($type, "Confirm Password")) {
                $rules["password_confirmation"] = implode("|", $parameter);
            } else if (str_contains($type, "Password")) {
                $rules["password"] = implode("|", $parameter);
            } else if (str_contains($type, "Name")) {
                $rules["name"] = implode("|", $parameter);
            } else if (str_contains($type, "Email")) {
                $rules["email"] = implode("|", $parameter);
            } else {
                $rules["id_question_{$value->id}"] = implode("|", $parameter);
            }            
        }
        
        return $rules;
    }

    public function names() {

        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();

        $names = [];

        foreach($fquestions as $key => $value) {       
            $type = $value->qtype->name;            
            if (str_contains($type, "Username")) {                
                $names["username"] = $value->question;   
            } else if (str_contains($type, "Confirm Password")) {                
                $names["password_confirmation"] = $value->question;   
            } else if (str_contains($type, "Password")) {                
                $names["password"] = $value->question;   
            } else if (str_contains($type, "Name")) {                
                $names["name"] = $value->question;   
            } else if (str_contains($type, "Email")) {   
                $names["email"] = $value->question;   
            } else {
                $names["id_question_{$value->id}"] = $value->question;   
            }                                          
        }

        return $names;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function percobaan()
    {        
        
        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Percobaan%');
        })->orderBy('order', 'asc')->get();
        
        $notifs = null;

        // return view('form.percobaan', compact('fquestions', 'notifs'));

        $random_string = md5(microtime());
        $first = substr($random_string, 0, 4);
        $last = substr($random_string, -4);
        $code = $first.$last;
        $array = [$random_string, $first, $last];        
        // return $code;

        // $code = "d734b7d7";
        // return view('emails.trackingcode', compact('code'));

        $fresult = Form_result::where('id_user', '=', '29')->get();

        return $fresult;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function percobaanstore(FormResultRequest $request)
    {                
        $input = $request->all();
        return $input;

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
                    $form_result->id_user = "12";

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
            $fr->id_user = '12';

            $fr->save();                        
        }

        return redirect('/crud/form/result');         
    }

    public function success() {
        return view('mms.pendaftaran-success');
    }
}

class formResult {
    public $id_question;
    public $answer_value;
    public $id_user;
    public $trackingcode;
}