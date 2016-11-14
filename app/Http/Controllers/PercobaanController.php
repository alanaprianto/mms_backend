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

class PercobaanController extends Controller
{
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
        // return $fresult;
        
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', '2016-09-29 04:33:52')->diffForHumans();
        // return $datetime;

        $notifs = \App\Helpers\Notifs::getNotifs();
        // return $notifs[0]->crt_human;

        // $code = "ASDADWKWK";
        // return view('emails.trackingcode', compact('code'));

        $name = "Syahril Rachman";
        $code = "AS32FLF9";
        $date = "2016-11-04 11:07:36";
        return view('emails.register_confirmation', compact('name', 'code', 'date'));        

        $name = "Syahril Rachman";
        $username = "syahril";
        $password = "ASDAD";
        // return view('emails.register_succesfull', compact('name', 'username', 'password'));


        $user = Auth::user();
        $fr = Form_result::                
                where('id_user', '=', $user->id)                
                ->where('id_question', '=', "1")
                ->first();

        $required = 0;
        $percentage = 0;
        $completed = 0;

        if ($fr) {
            $comp = $fr->answer;
            $btk = Str::upper($comp);

            $fqg1 = Form_question_group::where('name', 'like', '%'.$btk.'%')->first()->id;
            $fq1 = Form_question::where('group_question', '=', $fqg1)->count();

            $fqg2 = Form_question_group::where('name', 'like', '%Pendaftaran%')->first()->id;
            $fq2 = Form_question::where('group_question', '=', $fqg2)->count();

            $fqg3 = Form_question_group::where('name', 'like', '%Tahap 3%')->first()->id;
            $fq3 = Form_question::where('group_question', '=', $fqg3)->count();

            $required = $fq1+$fq2+$fq3;
            $completed = Form_result::where('id_user', '=', $user->id)->count();       
            $percentage = ($completed/$required) * 100;                
        }         

        if ($user->kta) {
            $kta = $user->kta->kta;
        } else {
            $kta = "";
        }
        
        $name = $user->name;
        $email = $user->email;        
        $username = $user->username;        
                
        return view('mms.profile.profile', compact('required', 'completed', 'percentage', 'kta', 'userdata',
                    'name', 'email', 'username'));
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
                    }         

                    // id user           
                    $form_result->id_user = "12";

                    $datas[] = $form_result;
                }
            } catch (\ErrorException $e) {
                
            }              
        }
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

        return redirect('/crud/form/result');         
    }
}

