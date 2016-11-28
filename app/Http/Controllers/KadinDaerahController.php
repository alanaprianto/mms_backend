<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_question;
use App\Http\Requests\FormResultRequest;
use App\Form_result;
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
                
        $totalmember = User::where('territory', '=', $terr)->where('role', '=', '2')->get()->count();        
        $totalverified = User::where('territory', '=', $terr)->where('role', '=', '2')
                            ->where('validation', '=', 'validated')
                            ->get()->count();
        $totalunverified = User::where('territory', '=', $terr)->where('role', '=', '2')
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

        $terr = Auth::user()->territory;
        $forms = Form_result::where('answer_value', '=', $terr)->get();

        $carbon = new Carbon();
        $monthsago = $carbon->subMonths(6)->month;
        $monthslater = new Carbon();

        $labels = array();
        $data = array();
        for ($i=$monthsago; $i != $monthslater->month+1 ; $i++) { 
            if ($i==12) {
                $i = 0;
            }

            $labels[] = date('F', strtotime("2000-$i-01"));
            $data[] = Form_result::where('answer_value', '=', $terr)->whereMonth('created_at', '=', $i)->count();
        }

        return view('daerah.form.submitted', compact('notifs', 'forms', 'labels', 'data'));
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

        try {
            $user->delete();
            // method delete folder n propic
            $deleted = true;
            $deletedMsg = "Data " . $name . " is deleted";
        }catch(\Exception $e){
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

        return view('daerah.form.detail', compact('notifs', 'detail'));   
    }
    
    /**
     * Memproses request datatable untuk list submittedForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxForms() {
        $terr = Auth::user()->territory;
        $codes = Form_result::where('answer_value', '=', $terr)->get()->pluck('trackingcode');

        $fr = Form_result::leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_question', '=', '8')
                ->whereIn('form_result.trackingcode', $codes)
                ->get();
        return Datatables::of($fr)->make(true);
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
        
        $terr = Auth::user()->territory;
        $members = User::where('territory', '=', $terr)->where('role', '=', '2')->get();

        $carbon = new Carbon();
        $monthsago = $carbon->subMonths(6)->month;
        $monthslater = new Carbon();

        $labels = array();
        $data = array();
        for ($i=$monthsago; $i != $monthslater->month+1 ; $i++) { 
            if ($i==12) {
                $i = 0;
            }

            $labels[] = date('F', strtotime("2000-$i-01"));
            $data[] = User::where('territory', '=', $terr)
                        ->where('role', '=', '2')
                        ->whereMonth('created_at', '=', $i)
                        ->count();
        }        
        
        return view('daerah.member.member', compact('notifs', 'members', 'labels', 'data'));
    }

    public function memberDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        $detail = Form_result::where('id_user', '=', $member->id)->get();

        $detail1 = \App\Helpers\Details::detail1($member->id);
        $detail2 = \App\Helpers\Details::detail2($member->id);
        $detail3 = \App\Helpers\Details::detail3($member->id);
        $docs = \App\Helpers\Details::docs($member->id);

        return view('daerah.member.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
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
        return Datatables::of($fr)->make(true);
    }

    public function notifall()
    {                           
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
        return view('daerah.notif.indexall', compact('notifs'));
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

                $deleted = true;
                $deletedMsg = "KTA request from " . $member->username . " is proceeded";      
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
}

class formResult {
    public $id_question;
    public $answer_value;
    public $id_user;
    public $trackingcode;
}