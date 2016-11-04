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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Form_question_group;
use Image;

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
        // return $fquestions;
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

        $id_namapenanggungjawab = Form_question::where('question', 'like', '%Nama Penanggung Jawab%')->first()->id;        
        $rules = $this->rules();
        
            $attributeNames = $this->names();
            
            // Create a new validator instance.
            $validator = Validator::make($input, $rules);
            $validator->setAttributeNames($attributeNames);

            if ($validator->passes()) {
                // $name = "Syahril Rachman";
                // $code = "AS32FLF9";
                // $date = "2016-11-04 11:07:36";
                // $email = 'rachman.syahril@gmail.com';
                // Mail::send('emails.register_confirmation', ['name' => $name, 'code' => $code, 'date' => $date], function($message) use ($email) {
                //     $message->from('no-reply@kadin-indonesia.org', 'no-reply');
                //     $message->to($email)->subject('Kadin Registration');                    
                // });
                // return $input;

                $random_string = md5(microtime());
                $first = substr($random_string, 0, 4);
                $last = substr($random_string, -4);
                $code = $first.$last;                                                        

                $admins = User::where('role', '=', '1')->get();                
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
                    // id question
                    if (str_contains($keys[2], "Provinsi")) {
                        $form_result->id_question = "Provinsi";
                    } else if (str_contains($keys[2], "KabKot")) {
                        $form_result->id_question = "Kabupaten / Kota";

                        $kadinKota = User::where('role', '=', '5')->where('territory', '=', $value)->get();                        
                        foreach ($kadinKota as $key => $kota) {
                            $notif = new Notification;

                            $notif->target = $kota->id;
                            $notif->sendercode = $code;
                            $notif->value = "New submitted form";
                            $notif->active = true;
                            
                            $notif->save();
                        }

                    } else if (str_contains($keys[2], "Alamat")) {
                        $form_result->id_question = "Alamat Lengkap";
                    } else if (str_contains($keys[2], "KodePos")) {
                        $form_result->id_question = "Kode Pos";
                    } else if (str_contains($keys[2], "fileupload")) {
                        $form_result->id_question = $keys[3];                    
                    } else {
                        $form_result->id_question = $keys[2];
                        if ($keys[2]==$id_namapenanggungjawab) {
                            $name = $value;
                        }
                    }

                    // answer value
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);
                    } else if ($request->hasFile($key)) {
                        $path = storage_path() . '/app/uploadedfiles/'.Auth::user()->username;                    
                        if(!\File::exists($path)) {
                            \File::makeDirectory($path);                            
                        } else {                            
                        }
                        
                        $uname = $keys[3];
                        $imageName = $uname.'.'.$request->$key->getClientOriginalExtension();                                                
                        $request->$key->move($path, $imageName);

                        $form_result->answer_value = $imageName;
                        // $file = $path.$imageName;        
                        // if(!\File::exists($file)) {
                        //     $form_result->answer_value = $file;
                        // } else {
                        //     $form_result->answer_value = "Failed to Upload File";
                        // }
                    } else {
                        $form_result->answer_value = $value;
                        if (str_contains($value, '@')) {
                            $email = $value;
                        }                        
                    }  

                    // tracking code                  
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

        $date = new Carbon();
        Mail::send('emails.register_confirmation', ['name' => $name, 'code' => $code, 'date' => $date], function($message) use ($email) {
            $message->from('no-reply@kadin-indonesia.org', 'no-reply');
            $message->to($email)->subject('Kadin Registration');                    
        });

        return redirect('/register1success'); 
    }

    /**
     * Menampilkan Halaman Registrasi user setelah pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function register($code)
    {               
        $results = Form_result::where('trackingcode', '=', $code)->get();
        if (count($results)<=0) {
          return redirect('/');
        } if ($results[0]->id_user) {
          return redirect('/');
        }

        $name = "";
        $email = "";
        $compclass = "";
        $compname = "";
        $territory = "";
        foreach ($results as $key => $result) {
            $question = $result->question;
            if (str_contains($question, "Nama Penanggung Jawab")) {
                $name = $result->answer;                
            } else if (str_contains($question, "Email Penanggung Jawab")) {
                $email = $result->answer;
            } else if (str_contains($question, "Bentuk Perusahaan")) {
                $compclass = $result->answer;
            } else if (str_contains($question, "Nama Perusahaan")) {
                $compname = $result->answer;
            } else if (str_contains($question, "Kabupaten / Kota")) {
                $territory = $result->answer_value;
            }
        }

        return view('mms.register', compact('code', 'name', 'email', 'compclass', 'compname', 'territory'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createuser(FormResultRequest $request)
    {        
         $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',            
        ]);
        $input = $request->all();        
        // return $input;

        $code = $input['trackingcode'];
        $name = $input['name'];
        $username = $input['username'];
        $email = $input['email'];
        $password1 = $input['password'];
        $password2 = $input['password_confirmation'];
        $territory = $input['territory'];

        $user = new User;

        $user->name = $name;
        $user->username = $username;
        $user->email = $email;
        $user->password = Hash::make($password1);
        $user->role = "2";
        $user->no_kta = "0";
        $user->no_rn = "0";
        $user->territory = $territory;

        $user->save();   

        $admins = User::where('role', '=', '1')->get();        
        foreach ($admins as $key => $admin) {
            $notif = new Notification;

            $notif->target = $admin->id;
            $notif->senderid = $user->id;
            $notif->value = "New User Registered";
            $notif->active = true;
                    
            $notif->save();
        }

        $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();
        foreach ($kadinKota as $key => $kota) {
            $notif = new Notification;

            $notif->target = $kota->id;
            $notif->senderid = $user->id;
            $notif->value = "New User Registered";
            $notif->active = true;
                    
            $notif->save();
        }

        $results = Form_result::where('trackingcode', '=', $code)->get();

        foreach ($results as $key => $result) {
            $result->id_user = $user->id;
            $result->save();
        }            

        $file = storage_path() . '/app/photoprofile/default-profile.png';
        $img = Image::make($file);
        $img->save(storage_path() . '/app/photoprofile'.'/'.$user->username.'.jpg');

        return redirect('/login');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexii()
    {        
        $user = Auth::user();
        $fr = Form_result::                
                where('id_user', '=', $user->id)
                ->where('id_question', '=', "1")
                ->first()->answer;
        $btk = Str::upper($fr);

        $tahap2 = Form_question_group::where('name', 'like', '%'.$btk.'%')->first()->id;
        $tahap3 = Form_question_group::where('name', 'like', '%Tahap 3%')->first()->id;

        // $fquestions = Form_question::whereHas('group', function ($q) use($btk) {        
        //     $q->whereIn('name', 'like', '%'.$btk.'%')
        //     ->where('name', 'like', '%Pendaftaran%');
        // })->orderBy('order', 'asc')->get();
        
        $fquestions = Form_question::whereIn('group_question', [1, $tahap2, $tahap3])->orderBy('group_question', 'asc')->orderBy('order', 'asc')->get();      
        $fresults = Form_result::where('id_user', '=', $user->id)->get();
        // return $fresults;
        return view('mms.tahapii-content', compact('fquestions', 'fresults'));
    }

    public function storeii(FormResultRequest $request)
    {        
        $input = $request->all();           

        // return $input;
        $rules = $this->rules();        
        $attributeNames = $this->names();
        $rules["email"] = "required";
        $rules = [];

        // Create a new validator instance.
        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($attributeNames);

        $userid = Auth::user()->id;
        $username = Auth::user()->username;
        $territory = Auth::user()->territory;

        if ($validator->passes()) {            
            $admins = User::where('role', '=', '1')->get();            
            foreach ($admins as $key => $admin) {
                $notif = new Notification;

                $notif->target = $admin->id;
                $notif->senderid = $userid;
                $notif->value = "User ".$username." updated his/her profile";
                $notif->active = true;
                    
                $notif->save();
            }

            $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();        
            foreach ($kadinKota as $key => $kota) {
                $notif = new Notification;

                $notif->target = $kota->id;
                $notif->senderid = $userid;
                $notif->value = "User ".$username." updated his/her profile";
                $notif->active = true;
                    
                $notif->save();
            }

        } else {                
            return Redirect::to('registerii')
                ->withInput(Input::except(['password', 'password_confirmation']))
                ->withErrors($validator);
        }

        $datas = array();
        foreach ($input as $key => $value) {
            $keys = explode("_", $key);
            $form_result = new formResult;

            try {
                if (!empty($keys[2])) {
                    // id question
                    if (str_contains($keys[2], "Provinsi")) {
                        $form_result->id_question = "Provinsi";
                    } else if (str_contains($keys[2], "KabKot")) {
                        $form_result->id_question = "Kabupaten / Kota";
                    } else if (str_contains($keys[2], "Alamat")) {
                        $form_result->id_question = "Alamat Lengkap";
                    } else if (str_contains($keys[2], "KodePos")) {
                        $form_result->id_question = "Kode Pos";
                    } else {
                        $form_result->id_question = $keys[2];
                    }

                    // answer value
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);
                    } else {
                        $form_result->answer_value = $value;
                        if (str_contains($value, '@')) {
                            $email = $value;
                        }
                    }                      
                    
                    if ($form_result->answer_value!="") {
                        $datas[] = $form_result;
                    }                     
                }
            } catch (\ErrorException $e) {
                return "Exception ".$e;
            }              
        }
        
        // return $datas;
        $terr = "";
        foreach ($datas as $data) {            
            $fr = Form_result::where('id_user', '=', $userid)->where('id_question', '=', $data->id_question)->first();
            if ($fr) {
                $fr->update([
                    'id_question' => $data->id_question,
                    'answer_value' => $data->answer_value,
                    'id_user' => $userid,                    
                ]);
            } else {
                $fr = new Form_result;

                $fr->id_question = $data->id_question;
                $fr->answer_value = $data->answer_value;
                $fr->id_user = $userid;                

                $fr->save(); 
            }

            if ($data->id_question=="Provinsi") {
                $terr = $data->answer_value;
            } else if ($data->id_question=="Kabupaten / Kota") {
                $terr = $data->answer_value;
            }
        }


        $user = Auth::user();
        $user->update([
                'territory' => $terr
            ]);

        return redirect('/profile'); 
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
            } else if (str_contains($type, "Address")) {
                $rules["id_question_Provinsi"] = implode("|", $parameter);
                $rules["id_question_KabKot"] = implode("|", $parameter);
                $rules["id_question_Alamat"] = implode("|", $parameter);
                $rules["id_question_KodePos"] = implode("|", $parameter);
            } else if (str_contains($type, "fileupload")) {
                $rules[$type] = implode("|", $parameter);                
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
            } else if (str_contains($type, "Address")) {   
                $names["id_question_Provinsi"] = "Provinsi";   
                $names["id_question_KabKot"] = "Kabupaten / Kota";
                $names["id_question_Alamat"] = "Alamat Lengkap";
                $names["id_question_KodePos"] = "Kode Pos";
            } else if (str_contains($type, "fileupload")) {
                $names[$type] = $value->question;
            } else {
                $names["id_question_{$value->id}"] = $value->question;
            }                                          
        }

        return $names;
    }    

    public function success() {
        return view('mms.pendaftaran-success');
    }

    public function pay1()
    {                
        
        return view('mms.pay1');
    }
}

class formResult {
    public $id_question;
    public $answer_value;
    public $id_user;
    public $trackingcode;
}