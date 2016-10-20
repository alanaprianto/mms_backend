<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_question;
use App\Form_result;
use Datatables;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use App\Kta;
use App\Notification;

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
        return view('daerah.dashboard.index', compact('notifs'));
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

    public function submittedFormDetail($code)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        
        $fr = Form_result::where('trackingcode', '=', $code)->get();

        return view('daerah.indexresult', compact('notifs'));   
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

        return view('daerah.member.detail', compact('notifs', 'member'));
    }

    public function ajaxMembers() {
        $terr = Auth::user()->territory;
        $ids = User::where('territory', '=', $terr)->where('role', '=', '2')->get();
        
        return Datatables::of($ids)->make(true);        
    }    

    public function ajaxMemberDetail($id) {        
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)->get();                
        return Datatables::of($fr)->make(true);
    }

    public function memberValidate($id) {
        $member = User::find($id);
        $member->verifiedemail = true;            
        $member->paid = "paid";
        $kta = Kta::where('owner', '=', $id)->first();

        try {
            $member->save();
            if (!$kta) {        
                $kta = new Kta;
                
                $kta->owner = $id;
                $kta->kta = 'requested';
                $kta->requested_at = new Carbon();
                $kta->granted_at = "";

                $kta->save();
            }
                        
            $idProv = substr(Auth::user()->territory, 0, 3);
            $idSender = $id;
            $provinsi = User::where('role', '=', '4')->where('territory', '=', $idProv)->get();                                
            foreach ($provinsi as $key => $prov) {
                $notif = new Notification;

                $notif->target = $prov->id;
                $notif->senderid = $idSender;
                $notif->value = "New Request KTA";
                $notif->active = true;

                $notif->save();                
            }

            $deleted = true;
            $deletedMsg = "Member " . $member->username . " is verified";            
        }catch(\Exception $e){
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
        return view('daerah.notif.indexresult', compact('notifs', 'code'));                
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
}
