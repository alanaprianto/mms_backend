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

        return view('daerah.register.register', compact('notifs'));
    }

    public function pendaftaran2()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('daerah.register.register2', compact('notifs'));
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

    public function notifAllAjax()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        
        return Datatables::of($notifs)->make(true);
    }

    public function paymentAjax($code) {        
        $fr = Payment::where('trackingcode', '=', $code)
                ->get();
        return Datatables::of($fr)->make(true);
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