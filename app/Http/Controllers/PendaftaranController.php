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
    
    public function indexFrame()
    {        
        
        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();
        
        return view('mms.pendaftaran-frame', compact('fquestions'));    
    }

    public function indexiiFrame()
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
        
        $fquestions = Form_question::whereIn('group_question', [$tahap2, $tahap3])->orderBy('group_question', 'asc')->orderBy('order', 'asc')->get();
        $fresults = Form_result::where('id_user', '=', $user->id)->get();
                
        return view('mms.tahapii-frame', compact('fquestions', 'fresults'));
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
        $alb = $request['alb'];

        $id_namapenanggungjawab = Form_question::where('question', 'like', '%Nama Penanggung Jawab%')->first()->id;
        $idfqg = Form_question_group::where('name', 'like', '%Pendaftaran%')->first()->id;
        $rules = $this->rules($idfqg);
        $attributeNames = $this->names($idfqg);
            
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

            // method tracking code lama
            // $random_string = md5(microtime());
            // $first = substr($random_string, 0, 4);
            // $last = substr($random_string, -4);
            // $code = $first.$last;

            $code = $this->getCode().'-ABS';
                
            $admins = User::where('role', '=', '1')->get();                
            foreach ($admins as $key => $admin) {
                \App\Helpers\Notifs::create($admin->id, null, $code, "New Submitted Form");
            }

            // notif kadin kabupaten/kota
        } else {
            return Redirect::to('register1')->withErrors($validator);
            // return Redirect::to('register1')
            //     ->withInput(Input::except(['password', 'password_confirmation']))
            //     ->withErrors($validator);
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
                            \App\Helpers\Notifs::create($kota->id, null, $code, "New Submitted Form");
                        }

                    } else if (str_contains($keys[2], "Alamat")) {
                        $form_result->id_question = "Alamat Lengkap";
                    } else if (str_contains($keys[2], "KodePos")) {
                        $form_result->id_question = "Kode Pos";
                    } else {
                        $form_result->id_question = $keys[2];
                        if ($keys[2]==$id_namapenanggungjawab) {
                            $name = $value;
                        }
                    }
                    // else if (str_contains($keys[2], "fileupload")) {
                    //     $form_result->id_question = $keys[3];                    
                    // } 

                    // answer value
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);                        
                    } else if ($request->hasFile($key)) {
                        $names = explode(".", $request->$key->getClientOriginalName());
                        $path = storage_path() . '/app/uploadedfiles/'.Auth::user()->username;
                        if(!\File::exists($path)) {
                            \File::makeDirectory($path);
                        } else {                            
                        }
                        
                        $uname = $keys[3];
                        // $imageName = $uname.'.'.$request->$key->getClientOriginalExtension();
                        $imageName = $names[0].'.'.$names[1];
                        $request->$key->move($path, $imageName);

                        // $form_result->answer_value = $imageName;
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
        // return $datas;
        //$input = $request->get('id_question');
        
        // return $email;        
        foreach ($datas as $data) {
            // $asdad = json_encode($data);
            // return $asdad;
            // Form_result::create($asdad);

            if ($data->id_question!="fileupload") {
                $fr = new Form_result;

                $fr->id_question = $data->id_question;
                $fr->answer_value = $data->answer_value;
                $fr->id_user = !empty($data->id_user) ? $data->id_user : '0';
                $fr->alb = false;
                $fr->trackingcode = $code;

                $fr->save();

            } else {
                
            }
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
        // $user->no_kta = "0";
        // $user->no_rn = "0";
        $user->territory = $territory;
        $user->validation = "not validated";

        $user->save();

        $admins = User::where('role', '=', '1')->get();        
        foreach ($admins as $key => $admin) {
            \App\Helpers\Notifs::create($admin->id, $user->id, null, "New User Registered");
        }

        $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();
        foreach ($kadinKota as $key => $kota) {
            \App\Helpers\Notifs::create($kota->id, $user->id, null, "New User Registered");
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
        // return "asdad1";
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
        
        $fquestions = Form_question::whereIn('group_question', [$tahap2, $tahap3])->orderBy('group_question', 'asc')->orderBy('order', 'asc')->get();
        $fresults = Form_result::where('id_user', '=', $user->id)->get();
        // return $fresults;
        return view('mms.tahapii-content', compact('fquestions', 'fresults'));
    }

    public function storeii(FormResultRequest $request, $idqg)
    {
        $input = $request->all();           
//         return $input;
        
        $fqg = Form_question_group::find($idqg);
        $alb = false;
        if ($fqg) {
            if ($fqg->name=="Anggota Luar Biasa") {
                $alb = true;
            }
        }

        $rules = $this->rules($idqg);           
        $attributeNames = $this->names($idqg);
        // $rules["email"] = "required";
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
                \App\Helpers\Notifs::create($admin->id, $userid, null, "User ".$username." updated his/her profile");
            }

            $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();        
            foreach ($kadinKota as $key => $kota) {
                \App\Helpers\Notifs::create($kota->id, $userid, null, "User ".$username." updated his/her profile");
            }

        } else {                
            if ($alb) {
                return Redirect::to('/alb/completeprofile/')
                ->withInput(Input::except(['password', 'password_confirmation']))
                ->withErrors($validator);
            } else {
                return Redirect::to('/member/completeprofile/'.$idqg)
                ->withInput(Input::except(['password', 'password_confirmation']))
                ->withErrors($validator);    
            }
            
        }

        $datas = array();
        $keyss = array(); // untuk debugging
        $filess = array(); // untuk debugging
        foreach ($input as $key => $value) {
            $keys = explode("_", $key);
            $form_result = new formResult;

            $keyss[] = $key;
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
                    // else if (str_contains($keys[2], "fileupload")) {
                    //     $form_result->id_question = $keys[3];
                    // } 

                    // answer value
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);
                        $filess[] = "tidak ada file1";
                    } else if ($request->hasFile($key)) {
                        $names = explode(".", $request->$key->getClientOriginalName());
                        $filess[] = "ada file ".$names[0];
                        $path = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/';
                        if(!\File::exists($path)) {
                            \File::makeDirectory($path);
                        }
                        
                        $uname = $keys[3];
                        // $imageName = $uname.'.'.$request->$key->getClientOriginalExtension();
                        $imageName = $names[0].'.'.$names[1];

                        // delete file sebelumnya
                        $filesInFolder = \File::files($path);
                        foreach($filesInFolder as $delPath)
                        {
                            $files = pathinfo($delPath);
                            if ($files['filename'] == $names[0]) { // uname diganti names[0]
                                $fileToDelete = $files['dirname'].'/'.$files['basename'];
                                \File::delete($fileToDelete);
                            } else if ($files['filename'] == $names[0].'-thumbs') { // uname diganti names[0]
                                $fileToDelete1 = $files['dirname'].'/'.$files['basename'];
                                \File::delete($fileToDelete1);
                            }
                        }

                        // update file image.
                        $request->$key->move($path, $imageName);
                    
                        $file = $path.$imageName;
                        if(\File::exists($file)) {
                            $form_result->answer_value = $imageName;
                            
                            // $thmbName = $uname.'-thumbs.'.$request->$key->getClientOriginalExtension();
                            $thmbName = $names[0].'-thumbs.'.$names[1];
                            $image = Image::make($file);
                            $image->fit(100, 100)->save($path.$thmbName);
                        } else {
                            $form_result->answer_value = "Failed to Upload File";
                        }

                    } else {
                        $form_result->answer_value = $value;
                        if (str_contains($value, '@')) {
                            $email = $value;
                        }
                        $filess[] = "tidak ada file2";
                    }                      
                    
                    if ($form_result->answer_value!="") {
                        $datas[] = $form_result;
                    }                     
                }
            } catch (\ErrorException $e) {
                return "Exception ".$e;
            }              
        }
        // return $filess;
        // return $keyss;
        // return $datas;

        $user = Auth::user();
        $terr = $user->territory;
        foreach ($datas as $data) {
            if ($data->id_question!="fileupload") {
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
            } else {

            }            
        }
        
        $user->update([
                'territory' => $terr
            ]);

        if ($alb) {
            return redirect('/alb/kta'); 
        } else {
            return redirect('/member/kta');
        }        
    }

    public function rules($idqg) {        
        $fquestions = Form_question::where('group_question', '=', $idqg)
                        ->orderBy('order', 'asc')->get();
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
                $rules[$type] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            } else {
                $rules["id_question_{$value->id}"] = implode("|", $parameter);
            }            
        }
        
        return $rules;
    }

    public function names($idqg) {

        // $fquestions = Form_question::whereHas('group', function ($q) {        
        //     $q->where('name', 'like', '%Pendaftaran%');
        // })->orderBy('order', 'asc')->get();

        $fquestions = Form_question::where('group_question', '=', $idqg)
                        ->orderBy('order', 'asc')->get();

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

    public function successframe() {
        return view('mms.pendaftaran-successframe');
    }

    public function index2()
    {                
        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Anggota Luar Biasa%');
        })->orderBy('order', 'asc')->get();
        
        return view('mms.pendaftaran2-content', compact('fquestions'));
    }

    public function store2(FormResultRequest $request)
    {        
        $input = $request->all();
        $alb = $request['alb'];
//         return $input;

        $id_nama = Form_question::where('question', 'like', '%Nama Asosiasi/Himpunan%')->first()->id;
        $idfqg = Form_question_group::where('name', 'like', '%Anggota Luar Biasa%')->first()->id;
        $rules = $this->rules($idfqg);
//        return $rules;
        $attributeNames = $this->names($idfqg);
            
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

                // method tracking code lama
                // $random_string = md5(microtime());
                // $first = substr($random_string, 0, 4);
                // $last = substr($random_string, -4);
                // $code = $first.$last;

                $code = $this->getCode().'-ALB';
                
                $admins = User::where('role', '=', '1')->get();
                foreach ($admins as $key => $admin) {
                    \App\Helpers\Notifs::create($admin->id, null, $code, "New Submitted Form");
                }

                // notif kadin kabupaten/kota
            } else {
                return Redirect::to('register2')->withErrors($validator);
                // return Redirect::to('register1')
                //     ->withInput(Input::except(['password', 'password_confirmation']))
                //     ->withErrors($validator);
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
                            \App\Helpers\Notifs::create($kota->id, null, $code, "New Submitted Form");
                        }

                    } else if (str_contains($keys[2], "Alamat")) {
                        $form_result->id_question = "Alamat Lengkap";
                    } else if (str_contains($keys[2], "KodePos")) {
                        $form_result->id_question = "Kode Pos";
                    } else {
                        $form_result->id_question = $keys[2];
                        if ($keys[2]==$id_nama) {
                            $name = $value;
                        }
                    }
                    // else if (str_contains($keys[2], "fileupload")) {
                    //     $form_result->id_question = $keys[3];                    
                    // } 

                    // answer value
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);                        
                    } else if ($request->hasFile($key)) {
                        $names = explode(".", $request->$key->getClientOriginalName());
                        $path = storage_path() . '/app/uploadedfiles1/'.$code;
                        if(!\File::exists($path)) {
                            \File::makeDirectory($path);
                        } else {                            
                        }
                        
                        $uname = $keys[3];
                        // $imageName = $uname.'.'.$request->$key->getClientOriginalExtension();
                        $imageName = $names[0].'.'.$names[1];
                        $request->$key->move($path, $imageName);

                        // $form_result->answer_value = $imageName;
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
        // return $datas;
        //$input = $request->get('id_question');
                
        foreach ($datas as $data) {
            // $asdad = json_encode($data);
            // return $asdad;
            // Form_result::create($asdad);
            if ($data->id_question=="fileupload") {

            } else {                
                $fr = new Form_result;

                $fr->id_question = $data->id_question;
                $fr->answer_value = $data->answer_value;
                $fr->id_user = !empty($data->id_user) ? $data->id_user : '0';
                $fr->alb = true;                
                $fr->trackingcode = $code;

                $fr->save();
            }
        }

        $date = new Carbon();
        Mail::send('emails.register_confirmation', ['name' => $name, 'code' => $code, 'date' => $date], function($message) use ($email) {
            $message->from('no-reply@kadin-indonesia.org', 'no-reply');
            $message->to($email)->subject('Kadin Registration');
        });            
        return redirect('/register1success');
    }

    public function getCode()
    {
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);
        return $string;
    }
}

class formResult {
    public $id_question;
    public $answer_value;
    public $id_user;
    public $trackingcode;
}