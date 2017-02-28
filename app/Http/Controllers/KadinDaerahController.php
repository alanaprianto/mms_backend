<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_question;
use App\Http\Requests\FormResultRequest;
use App\Form_result;
use App\Form_type;
use Datatables;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use App\Kta;
use App\Notification;
use App\Payment;
use App\Provinsi;
use App\Form_question_group;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Form_result_kadin_daerah;
use DB;
use Illuminate\Support\Collection;

class KadinDaerahController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {                       
    	$notifs = \App\Helpers\Notifs::getNotifs();

        $user = Auth::user();
        $terr = $user->territory;
        $totalsubmitted = Form_result::where('answer_value', '=', $terr)->get()->count();    
                
        $roles = [2, 6];
        $totalmember = User::where('territory', '=', $terr)->whereIn('role', $roles)->get()->count();        
        $totalverified = User::where('territory', '=', $terr)->whereIn('role', $roles)
                            ->where('validation', '=', 'validated')
                            ->get()->count();
        $totalunverified = User::where('territory', '=', $terr)->whereIn('role', $roles)
                            ->where('validation', '=', '')
                            ->get()->count();

        $totalunverified = $totalmember-$totalverified;
        $provcode = substr($terr, 0, 3);
        $provinsi = Provinsi::where('id', '=', $provcode)->first();
        return view('daerah.dashboard.index', compact('notifs', 'totalsubmitted', 'totalmember', 'totalverified', 'totalunverified', 'user', 'provinsi'));
    }

    /**
     * Menampilkan halaman Pendaftaran.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendaftaran()
    {                       
        $notifs = \App\Helpers\Notifs::getNotifs();

        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();

        return view('daerah.register.register', compact('notifs', 'fquestions'));
    }

    /**
     * Menampilkan halaman Submitted Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function submittedForms()
    {                       
        $notifs = \App\Helpers\Notifs::getNotifs();        
        return view('daerah.form.ab.index', compact('notifs'));
    }

    /**
     * Memproses request datatable untuk list submittedForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxForms() {
//        $terr = Auth::user()->territory;
//        $codes = Form_result::where('answer_value', '=', $terr)->get()->pluck('trackingcode');
//
//        $fr = Form_result::leftJoin('users', 'form_result.id_user', '=', 'users.id')
//                ->where('form_result.id_question', '=', '8')
//                ->whereIn('form_result.trackingcode', $codes)
//                ->get();
//        return Datatables::of($fr)->make(true);

        $terr = Auth::user()->territory;
        $codes = Form_result::where('alb', '!=', true)->where('answer_value', '=', $terr)->get()->pluck('trackingcode');

        $fq = Form_question::where('question', 'like', '%Nama Perusahaan%')->first();
        $fr = Form_result::
        where('id_question', '=', $fq->id)
            ->whereIn('form_result.trackingcode', $codes)
            ->get();

        $dt = new Collection;
        foreach ($fr as $key => $value) {
            $iduser = $value->id_user;
            $username = "-";
            if ($iduser) {
                $username = User::find($iduser)->username;
            }

            $dt->push([
                'answer' => $value->answer,
                'name' => $username,
                'created_at' => $value->created_at->format('Y-m-d H:i:s'),
                'trackingcode' => $value->trackingcode,
            ]);
        }
//         return $dt;
        return Datatables::of($dt)->make(true);
    }

    public function submittedFormsDelete($code)
    {
        $sforms = Form_result::where('trackingcode', '=', $code)->get();

        try {
            $name = "";
            foreach ($sforms as $key => $value) {
                $sform = $value;

                if ($sform->id_question=="8") {
                    $name = $sform->answer;
                }

                $sform->delete();
            }            
            $deleted = true;
            $deletedMsg = "Data " . $name . " is deleted";
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function memberDelete($id)
    {
        $user = User::where('id', '=', $id)->first();
        $name = "";
        $ext = "";

        try {
            \App\Helpers\Collaboration::deleteAccount($user->username);
            $user->delete();            

            $path = storage_path() . '/app/uploadedfiles/'.$user->username.'/';
            \File::deleteDirectory($path);
            
            $file = storage_path() . '/app/photoprofile'.'/';
            $filesInFolder = \File::files($file);

            foreach($filesInFolder as $path)
            {
                $files = pathinfo($path);
                if ($files['filename'] == $user->username) {                
                    $name = $files['filename'];
                    $ext = $files['extension'];

                    $img = storage_path() . '/app/photoprofile'.'/'.$name.'.'.$ext;
                    \File::Delete($img);
                }
            }

            $fr = Form_result::where('id_user', '=', $id)->get();
            foreach ($fr as $key => $result) {
                $result->id_user = "0";
                $result->update();
            }

            $deleted = true;
            $deletedMsg = "Data " . $name . " is deleted";
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            $deleted = true;
            $deletedMsg = "Data " . $name . " is deleted";
        } catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";
        }
        
        // hapus juga image profile
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function submittedFormDetail($code)
    {        
        $notifs = \App\Helpers\Notifs::getNotifs();        
        $detail = Form_result::where('trackingcode', '=', $code)->get();

        $notes = Form_result::where('trackingcode', '=', $code)
                    ->where('commentary', '!=', '')->count();
        $notes = $notes+Form_result::where('trackingcode', '=', $code)
                    ->where('correction', '!=', '')->count();

        return view('daerah.form.ab.detail', compact('notifs', 'detail', 'notes'));
    }

    /**
     * Memproses request datatable untuk result dengan code $code.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxFormDetail($code) {                
        $fr = Form_result::where('trackingcode', '=', $code)                
                ->get();
        return Datatables::of($fr)->make(true);        
    }
    
    /**
     * Menampilkan halaman Member.
     *
     * @return \Illuminate\Http\Response
     */
    public function member()
    {                       
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
        return view('daerah.member.ab.index', compact('notifs'));
    }

    public function memberDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        $trackingcode = Form_result::where('id_user', '=', $member->id)
            ->where('id_question', '=', 'Kode Pos')->first()->trackingcode;
        $detail = Form_result::where('id_user', '=', $member->id)->get();

        $detail1 = \App\Helpers\Details::detail1($member->id);
        $detail2 = \App\Helpers\Details::detail2($member->id);
        $detail3 = \App\Helpers\Details::detail3($member->id);
        $docs = \App\Helpers\Details::docs($member->id);

        $notes = Form_result::where('id_user', '=', $member->id)
                    ->where('commentary', '!=', '')->count();
        $notes = $notes+Form_result::where('id_user', '=', $member->id)
                    ->where('correction', '!=', '')->count();

        return view('daerah.member.ab.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3',
            'docs', 'trackingcode', 'notes'));
    }

    public function ajaxMembers() {
        $terr = Auth::user()->territory;
        // $ids = User::where('territory', '=', $terr)
        //         ->where('role', '=', '2')
        //         ->leftJoin('kta', 'kta.owner', '=', 'users.id')
        //         ->get();

        $ids = User::select( 'users.*',
            DB::raw('(select kta from kta where owner = users.id order by id asc limit 1) as kta'),
            DB::raw('(select perpanjangan from kta where owner = users.id order by id asc limit 1) as ext')  )     
            ->where('territory', '=', $terr)
            ->where('role', '=', '2')
            ->get();

        
        return Datatables::of($ids)->make(true);        
    }    

    public function ajaxMemberDetail($id) {        
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)->get();
        return Datatables::of($fr)->make(true);
    }

    public function memberValidate(Request $request, $id) {           
        try {
            $kadindaerah = Auth::user();
            $form = Form_result_kadin_daerah::where('id', '=', $id)->first();
            $request['validated_by'] = $kadindaerah->id;
            $request['validated_at'] = new Carbon();
            $form->update($request->all());

            $deleted = true;
            $deletedMsg = "Question " . $form->question . " is verified";
            
        }catch(\Exception $e) {
            $deleted = false;
            $deletedMsg = "Error while verifying member";            
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function profile() {
        $notifs = \App\Helpers\Notifs::getNotifs();

        $user = Auth::user();
        $fr = Form_result::                
                where('id_user', '=', $user->id)                
                ->where('id_question', '=', "1")
                ->first();

        $required = 0;
        $percentage = 0;
        $completed = 0;

        if ($fr) {
            $fr = $fr->answer;
            $btk = Str::upper($fr);

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

        $kta = $user->kta->kta;

        return view('daerah.profile.profile', compact('notifs', 'required', 'completed', 'percentage', 'kta'));
    }

    /**
     * Menangani permintaan detail notif
     *
     * @return \Illuminate\Http\Response
     */
    public function notif($id)
    {                           
        $notif = Notification::find($id);

        $notif->active=false;
        $notif->save();

        $notifs = \App\Helpers\Notifs::getNotifs();
        
        if ($notif->senderid) {
            $user = User::find($notif->senderid);            
            $id = "0";
            if ($user) {
               $id = $user->id;             
            }
            if (str_contains($notif->value, 'Extension')) {
                $id = $notif->sendercode;
            }
            return view('daerah.notif.indexuser', compact('notifs', 'id'));
        }

        $code = $notif->sendercode;       
        $detail  = Form_result::where('trackingcode', '=', $code)->get();         
        return view('daerah.notif.indexresult', compact('notifs', 'code', 'detail'));                
    }

    public function notifresultAjax($code) {        
        $fr = Form_result::where('trackingcode', '=', $code)->get();
                // leftJoin('form_question', 'form_result.id_question', '=', 'form_question.id')          
                // leftJoin('users', 'form_result.id_user', '=', 'users.id')
                // ->select(['form_question.question', 'form_result.answer_value', 'form_result.trackingcode', 'form_result.id_question',
                //         'form_result.created_at']);        
        return Datatables::of($fr)->make(true);        
    }

    public function notifuserAjax($id) {        
        $fr = User::
                where('id', '=', $id)->get();
                // ->select(['id', 'name', 'username', 'email']);
        $fr = User::select( 'users.*',
            DB::raw('(select kta from kta where owner = users.id order by id asc limit 1) as kta'),
            DB::raw('(select perpanjangan from kta where owner = users.id order by id asc limit 1) as ext')  )
            ->where('id', '=', $id)
            ->whereIn('role', [2, 6])
            ->get();
        return Datatables::of($fr)->make(true);
    }

    public function notifall()
    {                           
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
        return view('common.notif.indexall', compact('notifs'));
    }

    public function paymentAjax($code) {        
        $fr = Payment::where('trackingcode', '=', $code)
                ->get();
        return Datatables::of($fr)->make(true);
    }

    public function store(FormResultRequest $request)
    {        
        $input = $request->all();                

        $id_namapenanggungjawab = Form_question::where('question', 'like', '%Nama Penanggung Jawab%')->first()->id;
        $idfqg = Form_question_group::where('name', 'like', '%Pendaftaran%')->first()->id;
        $rules = $this->rules($idfqg);
        
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

                // $random_string = md5(microtime());
                // $first = substr($random_string, 0, 4);
                // $last = substr($random_string, -4);
                // $code = $first.$last;

                $code = $this->getCode().'-ABS';
                
                $admins = User::where('role', '=', '1')->get();                
                foreach ($admins as $key => $admin) {
                    \App\Helpers\Notifs::create($admin->id, null, $code, "New Submitted Form");
                }

            } else {                
                return Redirect::to('register1frame')
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
                            \App\Helpers\Notifs::create($kota->id, null, $code, "New Submitted Form");
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

        return redirect('/register1successframe'); 
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

    public function memberReqKta(Request $request) {
        $keterangan = $request['keterangan'];
        $id_owner = $request['id_user'];

        $kta = Kta::where('owner', '=', $id_owner)->first();

        if ($kta) {
            try {
                $kta->kta = "validated";
                $kta->keterangan = $keterangan;
                $kta->save();

                $member = User::where('id', '=', $id_owner)->first();
                $member->update([
                    'validation' => 'validated'
                ]);

                $ext = str_contains($kta->perpanjangan, 'processed');
                $msg = "KTA Request";
                if ($ext) {
                    $msg = "KTA Extension Request";
                }

                $idProv = substr(Auth::user()->territory, 0, 3);
                $idSender = Auth::user()->id;
                $provinsi = User::where('role', '=', '4')->where('territory', '=', $idProv)->get();
                foreach ($provinsi as $key => $prov) {
                    \App\Helpers\Notifs::create($prov->id, $idSender, null, $msg." from ".$member->username);
                }

                \App\Helpers\Notifs::create($member->id, $idSender, null, "Your ".$msg." is Validated");

                $deleted = true;
                $deletedMsg = $msg." from " . $member->username . " is proceeded";
            }catch(\Exception $e){
                $deleted = false;
                $deletedMsg = "Error while executing command";

                $kta->kta = "requested";
                $kta->keterangan = "";
                $kta->save();

                $member = User::where('id', '=', $id_owner)->first();
                $member->update([
                    'validation' => ''
                ]);
            }        
        } else {
            $deleted = false;
            $deletedMsg = "Data is not available";
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function memberPostKta(Request $request) {
        $keterangan = $request['keterangan'];
        $id_owner = $request['id_user'];
        $kta = Kta::where('owner', '=', $id_owner)->first();
        if ($kta) {
            try {
                $kta->kta = "postponed";
                $kta->keterangan = $keterangan;
                $kta->save();

                $member = User::where('id', '=', $id_owner)->first();
                $member->update([
                    'validation' => 'postponed'
                ]);

                $ext = str_contains($kta->perpanjangan, 'processed');
                $msg = "KTA Request";
                if ($ext) {
                    $msg = "KTA Extension Request";
                }

                $idSender = Auth::user()->id;
                \App\Helpers\Notifs::create($member->id, $idSender, null, "Your ".$msg." is Postponed");

                $deleted = true;
                $deletedMsg = $msg." from " . $member->username . " is Postponed";
            }catch(\Exception $e){
                return $e;
                $deleted = false;
                $deletedMsg = "Error while executing command";
            }
        } else {
            $deleted = false;
            $deletedMsg = "Data is not available";
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function submittedAlbForms()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('daerah.form.alb.index', compact('notifs'));
    }

    public function ajaxAlbForms() {
        $terr = Auth::user()->territory;
        $codes = Form_result::where('alb', '=', true)->where('answer_value', '=', $terr)->get()->pluck('trackingcode');

        $fq = Form_question::where('question', 'like', '%Nama Asosiasi/Himpunan%')->first();
        $fr = Form_result::
                where('id_question', '=', $fq->id)
                ->whereIn('form_result.trackingcode', $codes)
                ->get();

        $dt = new Collection;
        foreach ($fr as $key => $value) {
            $iduser = $value->id_user;
            $username = "-";
            if ($iduser) {
                $username = User::find($iduser)->username;
            }      

            $dt->push([                       
                    'answer' => $value->answer,
                    'username' => $username,
                    'created_at' => $value->created_at->format('Y-m-d H:i:s'),
                    'trackingcode' => $value->trackingcode,
                ]);
        }
        // return $dt;
        return Datatables::of($dt)->make(true);
    }

    public function submittedAlbFormDetail($code)
    {        
        $notifs = \App\Helpers\Notifs::getNotifs();        
        $detail = Form_result::where('trackingcode', '=', $code)->get();

        $fq = Form_question::where('question', 'like', '%Nama Asosiasi/Himpunan%')->first();
        $fr = Form_result::where('id_question', '=', $fq->id)->first();
        $name = $fr->answer;
        $trcode = $fr->trackingcode;

        $notes = Form_result::where('trackingcode', '=', $code)
            ->where('commentary', '!=', '')->count();
        $notes = $notes+Form_result::where('trackingcode', '=', $code)
                ->where('correction', '!=', '')->count();

        return view('daerah.form.alb.detail', compact('notifs', 'detail', 'name', 'trcode', 'notes'));
    }

    public function submittedAlbApprove(Request $request) {           
        $trcode = $request['trackingcode'];

        if (!$trcode) {
            return response()->json(['success' => false, 'msg' => 'Request is Not Understood']);
        } 

        $results = Form_result::where('trackingcode', '=', $trcode)->get();
        if (count($results)<=0) {
          return response()->json(['success' => false, 'msg' => 'Data is Not Available']);
        } if ($results[0]->id_user) {
          return response()->json(['success' => false, 'msg' => 'Data is Not Available']);
        }

        $name = "";
        $username = "";
        $email = "";        
        $territory = "";
        $random_string = "";

        $user = new User;
        $payment = new Payment;
        try {            
            foreach ($results as $key => $result) {
                $question = $result->question;
                if (str_contains($question, "Nama Asosiasi/Himpunan")) {
                    $name = $result->answer;                
                } else if (str_contains($question, "E-Mail")) {
                    $email = $result->answer;
                } else if (str_contains($question, "Kabupaten / Kota")) {
                    $territory = $result->answer_value;
                }
            }        
          
            $random_string = md5(microtime());
            $first = substr($random_string, 0, 4);
            $last = substr($random_string, -4);
            $username = $first.$last;            
            
            $user->name = $name;
            $user->username = $username; //ini
            $user->email = $email;
            $user->password = Hash::make($random_string); //ini
            $user->role = "6";
            // $user->no_kta = "0";
            // $user->no_rn = "0";
            $user->territory = $territory;
            $user->save();

            $userid = $user->id;
            $attempt = Payment::where('id_user', $userid)->count()+1;        
            $input['id_user'] = $userid;
            $input['attempt'] = $attempt;
            $input['amount'] = 500000;
            $input['payment_date'] = new Carbon();        
            $payment = Payment::create($input);

            $results = Form_result::where('trackingcode', '=', $trcode)->get();
            foreach ($results as $key => $result) {
                $result->id_user = $user->id;
                $result->update();
            }

            Mail::send('emails.register_succesfull', ['name' => $name, 'username' => $username, 'password' => $random_string], function($message) use ($email) {
                $message->from('no-reply@kadin-indonesia.org', 'no-reply');
                $message->to($email)->subject('Kadin Registration');                    
            }); 

            $admins = User::where('role', '=', '1')->get();        
            foreach ($admins as $key => $admin) {
                \App\Helpers\Notifs::create($admin->id, $user->id, null, "New Extraordinary User Registered");
            }

            // $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();
            // foreach ($kadinKota as $key => $kota) {
            //     $notif = new Notification;

            //     $notif->target = $kota->id;
            //     $notif->senderid = $user->id;
            //     $notif->value = "New Extraordinary User Registered";
            //     $notif->active = true;
                        
            //     $notif->save();
            // }

            $pathold = storage_path() . '/app/uploadedfiles1/'.$trcode.'/';
            $pathnew = storage_path() . '/app/uploadedfiles/'.$username.'/';
            \File::copyDirectory($pathold, $pathnew);

            $name = "";
            $ext = "";
            $file = storage_path() . '/app/uploadedfiles1/'.$trcode;
            $filesInFolder = \File::files($file);
                
            foreach($filesInFolder as $path)
            {
                $files = pathinfo($path);            
                if ($files['filename'] == Auth::user()->username) {                
                    $name = $files['filename'];
                    $ext = $files['extension'];

                    $imgold = storage_path() . '/app/uploadedfiles1/'.$trcode.'/'.$name.'.'.$ext;
                    $imgnew = storage_path() . '/app/uploadedfiles/'.$username.'/'.$name.'.'.$ext;
                    \File::move($imgold, $imgnew);
                }
            }

            \File::deleteDirectory($pathold);

            $deleted = true;
            $deletedMsg = 'Account for '.$name.' is created !';
        } catch(\Exception $e){
            $user->delete();
            $payment->delete();
            $results = Form_result::where('trackingcode', '=', $trcode)->get();
            foreach ($results as $key => $result) {
                $result->id_user = "0";
                $result->update();
            }
            $deleted = false;
            $deletedMsg = "Error in Creating Account!";
        }
                
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
    
    public function memberAlb()
    {                       
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
        return view('daerah.member.alb.index', compact('notifs'));
    }

    public function ajaxAlbMembers() {
        $terr = Auth::user()->territory;
        // $ids = User::where('territory', '=', $terr)
        //         ->where('role', '=', '2')
        //         ->leftJoin('kta', 'kta.owner', '=', 'users.id')
        //         ->get();

        $ids = User::select( 'users.*',
            DB::raw('(select kta from kta where owner = users.id order by id asc limit 1) as kta'),
            DB::raw('(select perpanjangan from kta where owner = users.id order by id asc limit 1) as ext')  )     
            ->where('territory', '=', $terr)
            ->where('role', '=', '6')
            ->get();

        // return $ids;        
        return Datatables::of($ids)->make(true);        
    }  
        
    public function memberAlbDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        $detail = Form_result::where('id_user', '=', $member->id)->get();

        $fileqg = Form_type::where('name', 'like', '%File Upload%')->pluck('id');
        $fileq = Form_question::whereIn('type', $fileqg)->pluck('id')->toArray();

        $notes = Form_result::where('id_user', '=', $member->id)
            ->where('commentary', '!=', '')->count();
        $notes = $notes+Form_result::where('id_user', '=', $member->id)
                ->where('correction', '!=', '')->count();

        return view('daerah.member.alb.detail', compact('notifs', 'member', 'detail', 'fileq', 'notes'));
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