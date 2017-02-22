<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_question;
use App\Form_result;
use Carbon\Carbon;
use App\Http\Requests\FormResultRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Form_question_group;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Image;
use App\Form_result_kadin_daerah;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Laracurl;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class PercobaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function percobaan()
    {        
        // $url = Laracurl::buildUrl('https://kadin-member.cf/api/v1/users.list', ['X-Auth-Token' => '_Bz8nfexCYRC96kQhK3e6GFOe8O-z3uHgpxeBo_FV7E', 'X-User-Id' => 'YnGx6ioBwxwrQtwGK']);
        // $response = Laracurl::get($url);
        // // $response = Laracurl::post($url, ['name' => 'asdad', "email" => "email@user.tld", "password" => "anypassyouwant", "username" => "uniqueusername"]);
        // // return $response;

        // $url = Laracurl::buildUrl('https://kadin-member.cf/api/v1/login', []);
        // $response = Laracurl::post($url, ['user' => 'admin', 'password' => '123qweasdzxc']);      
        // $asdad = json_encode($response->body);
        // dd($response);

        // $request = \Illuminate\Http\Request::create('https://kadin-member.cf/api/v1/login', 'POST', ['user' => 'admin', 'password' => '123qweasdzxc']);        
        // return $request;
//        $name = "Asdad Swardada";
//    	$username = "asdad";
//    	$email = "asdad.swardada@gmail.com";
//    	$password = "Asdad123!";
//        try {
//           	$client = new \GuzzleHttp\Client(['base_uri' => 'https://kadin-member.cf/api/']);
//           	$response = $client->request('POST', 'v1/login', [
//                    'headers' => [
//                    ],
//                    'json' => ['user' => 'admin', 'password' => '123qweasdzxc']
//            ]);
//            $json = json_decode($response->getBody(true), true);
//            $authtoken = $json['data']['authToken'];
//            $authId = $json['data']['userId'];
//
//            $response = $client->request('GET', 'v1/users.list', [
//            	'headers' => [
//            		'X-Auth-Token' => $authtoken,
//            		'X-User-Id' => $authId
//            	],
//            	'json' => []
//            ]);
//
//            $userId = '';
//            $userExist = false;
//            $lusers = json_decode($response->getBody(true), true);
//            $users = $lusers['users'];
//            foreach ($users as $key => $user) {
//            	if ($user['username']==$username) {
//            		$userExist = true;
//                    $userId = $user['_id'];
//            	}
//            }
//
//            if ($userExist) {
//            	// $response = $client->request('POST', 'v1/users.update', [
//             //            'headers' => [
//             //                'X-Auth-Token' => $authtoken,
//             //                'X-User-Id' => $authId,
//             //                'Content-type' => 'application/json'
//             //            ],
//             //            'json' => ['userId' => $userId, 'data' => ['name' => 'Asdad Swardada1', 'email' => 'asdad.swardada@gmail.com1', 'username' => 'asdad1']]
//             //    ]);
//
//             //    $usercrt = json_decode($response->getBody(true), true);
//             //    return $response;
//
//                $response = $client->request('POST', 'v1/users.update', [
//                        'headers' => [
//                            'X-Auth-Token' => $authtoken,
//                            'X-User-Id' => $authId,
//                            'Content-type' => 'application/json'
//                        ],
//                        'json' => ['userId' => $userId]
//                ]);
//
//                $dltjson = json_decode($response->getBody(true), true);
//                return $response;
//            } else {
//            	$response = $client->request('POST', 'v1/users.create', [
//	                    'headers' => [
//	                        'X-Auth-Token' => $authtoken,
//            				'X-User-Id' => $userId,
//	                        'Content-type' => 'application/json'
//	                    ],
//	                    'json' => ['name' => $name, 'email' => $email, 'password' => $password, 'username' => $username]
//	            ]);
//	            $usercrt = json_decode($response->getBody(true), true);
//	            $success = $usercrt['success'];
//	            if (!$success) {
//	            	return "Failed Creating User, Failing Process";
//	            } else {
//	            	return "User Created";
//	            }
//            }
//
//			$response = $client->request('GET', 'v1/logout', [
//            	'headers' => [
//            		'X-Auth-Token' => $authtoken,
//            		'X-User-Id' => $userId
//            	],
//            	'json' => []
//            ]);
//        } catch (RequestException $e) {
//            $response = json_decode($e->getResponse()->getBody(true));
//            $json = $response;
//        }
//        return $response;
//
//        $random_string = md5(microtime());
//        $first = substr($random_string, 0, 4);
//        $last = substr($random_string, -4);
//        $code = $first.$last;
//
//        $code = $this->getCode().'-ABS';
//
//        return view('percobaan-mainapp', compact('code'));

        // $form = Form_result_kadin_daerah::where('id', '=', '525')->first();
        // // return $form;

        // $fquestions = Form_question::whereHas('group', function ($q) {        
        //     $q->where('name', 'like', '%Upload%');
        // })->orderBy('order', 'asc')->get();        
        // $notifs = null;
        // // return view('form.percobaan', compact('fquestions', 'notifs'));

        // $random_string = md5(microtime());
        // $first = substr($random_string, 0, 4);
        // $last = substr($random_string, -4);
        // $code = $first.$last;
        // $array = [$random_string, $first, $last];        
        // // return $code;

        // // $code = "d734b7d7";
        // // return view('emails.trackingcode', compact('code'));

        // $fresult = Form_result::where('id_user', '=', '29')->get();
        // // return $fresult;
        
        // $datetime = Carbon::createFromFormat('Y-m-d H:i:s', '2016-09-29 04:33:52')->diffForHumans();
        // // return $datetime;

        // $notifs = \App\Helpers\Notifs::getNotifs();
        // // return $notifs[0]->crt_human;

        // // $code = "ASDADWKWK";
        // // return view('emails.trackingcode', compact('code'));

        // $name = "Syahril Rachman";
        // $code = "AS32FLF9";
        // $date = "2016-11-04 11:07:36";
        // // return view('emails.register_confirmation', compact('name', 'code', 'date'));        

         $name = "Syahril Rachman";
         $username = "syahril";
         $password = "ASDAD";
         $position = "WKU Bidang Konstruksi dan Infrastruktur";
          return view('emails.register_chat', compact('name', 'username', 'password', 'position'));

        // $user = Auth::user();
        // $fr = Form_result::                
        //         where('id_user', '=', $user->id)                
        //         ->where('id_question', '=', "1")
        //         ->first();

        // $required = 0;
        // $percentage = 0;
        // $completed = 0;

        // if ($fr) {
        //     $comp = $fr->answer;
        //     $btk = Str::upper($comp);

        //     $fqg1 = Form_question_group::where('name', 'like', '%'.$btk.'%')->first()->id;
        //     $fq1 = Form_question::where('group_question', '=', $fqg1)->count();

        //     $fqg2 = Form_question_group::where('name', 'like', '%Pendaftaran%')->first()->id;
        //     $fq2 = Form_question::where('group_question', '=', $fqg2)->count();

        //     $fqg3 = Form_question_group::where('name', 'like', '%Tahap 3%')->first()->id;
        //     $fq3 = Form_question::where('group_question', '=', $fqg3)->count();

        //     $required = $fq1+$fq2+$fq3;
        //     $completed = Form_result::where('id_user', '=', $user->id)->count();       
        //     $percentage = ($completed/$required) * 100;                
        // }         

        // if ($user->kta) {
        //     $kta = $user->kta->kta;
        // } else {
        //     $kta = "";
        // }
        
        // $name = $user->name;
        // $email = $user->email;        
        // $username = $user->username;        
                
        // // return view('mms.profile.profile', compact('required', 'completed', 'percentage', 'kta', 'userdata',
        //             // 'name', 'email', 'username'));
        // // return view('percobaan');

        $kta = "asdad";
        $rn = "asdad";
        $exp = "asdad";
        
        $compname = "asdad";
        $complead = "asdad";
        $compaddr = "asdad";
        $compbdus = "asdad";
        $comppermit = "asdad";
        $compqual = "asdad";
        $jabatan = "asdad";
        $postcode = "asdad";
        $compnpwp = "asdad";
        $daerah = "asdad";
        $provinsi = "asdad";
        return view('percobaan-ktaprint', compact('kta', 'rn', 'exp',
                'compname', 'complead', 'compaddr', 'compbdus', 'comppermit', 'compqual', 'jabatan', 'postcode', 'compnpwp', 'daerah', 'provinsi'));
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
        // return $input;

        $rules = $this->rules(24);        
        $attributeNames = $this->names(24);
            
        // Create a new validator instance.
        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($attributeNames);

        if (!$validator->passes()) {
            return Redirect::to('percobaan')->withErrors($validator);
        }

        $datas = array();
        $files = array();
        $ajig = array();
        foreach ($input as $key => $value) {
            $keys = explode("_", $key);
            $form_result = new formResult;

            $ajig[] = $key;
            try {
                if (!empty($keys[2])) {
                    // id question                    
                    if (str_contains($keys[2], "Provinsi")) {
                        $form_result->id_question = "Provinsi";
                    } else if (str_contains($keys[2], "KabKot")) {
                        $form_result->id_question = "Kabupaten / Kota";

                        // $kadinKota = User::where('role', '=', '5')->where('territory', '=', $value)->get();                        
                        // foreach ($kadinKota as $key => $kota) {
                        //     $notif = new Notification;

                        //     $notif->target = $kota->id;
                        //     $notif->sendercode = $code;
                        //     $notif->value = "New submitted form";
                        //     $notif->active = true;
                            
                        //     $notif->save();
                        // }

                    } else if (str_contains($keys[2], "Alamat")) {
                        $form_result->id_question = "Alamat Lengkap";
                    } else if (str_contains($keys[2], "KodePos")) {
                        $form_result->id_question = "Kode Pos";
                    } else if (str_contains($keys[2], "fileupload")) {
                        $form_result->id_question = $keys[3];
                    } else {
                        $form_result->id_question = $keys[2];
                    }

                    // answer value                    
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);
                        $files[] = "tidak ada file1";
                    } else if ($request->hasFile($key)) {
                        $names = explode(".", $request->$key->getClientOriginalName());
                        $files[] = "ada file ".$names[0];
                        $path = storage_path() . '/app/uploadedfiles/percobaan';
                        if(!\File::exists($path)) {
                            \File::makeDirectory($path);                            
                        }
                        
                        $uname = $keys[3];
                        // $imageName = $uname.'.'.$request->$key->getClientOriginalExtension();
                        // $imageName = $request->$key->getClientOriginalName();
                        $imageName = $names[0].'.'.$names[1];
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
                        $files[] = "tidak ada file2";
                        $form_result->answer_value = $value;
                    }
                    
                    // id user
                    $form_result->id_user = "12";
                    // $form_result->id_user = Auth::user()->id;

                    $datas[] = $form_result;
                }
            } catch (\ErrorException $e) {
                return $e;                
            }              
        }
        // return $ajig;
        // return $files;
        // return $datas;
        //$input = $request->get('id_question');
                
        foreach ($datas as $data) {
            // $asdad = json_encode($data);
            // return $asdad;
            // Form_result::create($asdad);

            $fr = new Form_result;

            $fr->id_question = $data->id_question;
            $fr->answer_value = $data->answer_value;
            $fr->id_user = $data->id_user;

            $fr->save();                        
        }

        return redirect('/admin/result');         
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

    public function rchatLogin()
    {
      try {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://kadin-member.cf/api/']);             

        $response = $client->request('POST', 'v1/login', [
                    'headers' => [
                            'Origin' => 'https://kadin-member.cf',
                            'X-Auth-Token' => '',
                            'Accept' => 'application/json',
                    ],                            
                    'json' => ['user' => 'admin', 'password' => '123qweasdZXc']
        ]);

                    // $response = $client->request('POST', 'v1/users.create', [
                    //         'headers' => [
                    //             'X-Auth-Token' => '6iurmF1SaKq682NFy8HDF2lxXA3tWFcGkkvw8JSQpyR',
                    //             'X-User-Id' => 'S3L2dshaFzbkhHs9W',
                    //             'Content-type' => 'application/json'
                    //         ],
                    //         'json' => ['name' => $name, 'email' => $email, 'password' => $password1, 'username' => $username]
                    //     ]);   
                } catch (RequestException $e) {                    
                    $response = json_decode($e->getResponse()->getBody(true));                    
                }

        return $response;
    }
}

class formResult {
    public $id_question;
    public $answer_value;
    public $id_user;
    public $trackingcode;
}