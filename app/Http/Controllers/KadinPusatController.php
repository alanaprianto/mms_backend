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
use DB;
use App\Notification;
use App\Form_question_group;
use Illuminate\Support\Str;
use App\Regnum;

class KadinPusatController extends Controller
{
    public function dashboard()
    {                       
    	$notifs = \App\Helpers\Notifs::getNotifs();

        $user = Auth::user();
        $terr = $user->territory;
        $owner = User::where('territory', 'like', $terr.'%')->where('role', '=', 2)->pluck('id');

        $totalkta = Kta::where('kta', '<>', 'requested')
                    ->where('kta', '<>', 'cancelled')
                    ->whereIn('owner', $owner)
                    ->get()->count();
        $totalreqkta = Kta::where('kta', '=', 'requested')->whereIn('owner', $owner)->get()->count();
        $totalcancelkta = Kta::where('kta', '=', 'cancelled')->whereIn('owner', $owner)->get()->count();

        return view('pusat.dashboard.index', compact('notifs', 'totalkta', 'totalreqkta', 'totalcancelkta', 'user'));
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
        
        return redirect('dashboard/pusat');
    }    

    public function notifall()
    {                           
        $notifs = \App\Helpers\Notifs::getNotifs();                
        return view('pusat.notif.indexall', compact('notifs'));
    }

    public function rnList()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        
        $rn = Regnum::where('regnum', '<>', 'requested')
                    ->where('regnum', '<>', 'cancelled')
                    ->get();

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
            $data[] = Regnum::where('regnum', '<>', 'requested')
                        ->where('regnum', '<>', 'cancelled')
                        ->whereMonth('created_at', '=', $i)
                        ->count();
        }

        return view('pusat.rn.list.index', compact('notifs', 'rn', 'labels', 'data'));
    }

    public function ajaxRnList() {        
        $rn = Regnum::where('regnum', '<>', 'requested')
                ->where('regnum', '<>', 'cancelled')
                ->pluck('owner');
                
        $fr = Form_result::leftJoin('regnum', 'form_result.id_user', '=', 'regnum.owner')
                ->where('form_result.id_question', '=', '8')
                ->whereIn('form_result.id_user', $rn)
                ->get();        
        return Datatables::of($fr)->make(true);
    }
    
    public function rnListDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);        

        $detail1 = $this->detail1($member->id);
        $detail2 = $this->detail2($member->id);
        $detail3 = $this->detail3($member->id);
        $docs = $this->docs($member->id);

        return view('pusat.rn.list.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
    }

    public function rnRequestDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);        

        $detail1 = $this->detail1($member->id);
        $detail2 = $this->detail2($member->id);
        $detail3 = $this->detail3($member->id);
        $docs = $this->docs($member->id);

        return view('pusat.rn.request.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
    }

    public function rnRequest()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        

        $rn = Regnum::where('regnum', '=', 'requested')->get();

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
            $data[] = Regnum::where('regnum', '=', 'requested')->whereMonth('created_at', '=', $i)->count();            
        }


        return view('pusat.rn.request.index', compact('notifs', 'rn', 'labels', 'data'));
    }

    public function ajaxRnRequest() {        
        $rn = Regnum::where('regnum', '=', 'requested')->pluck('owner');

        $fr = Form_result::leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('id_question', '=', '8')
                ->whereIn('id_user', $rn)                
                ->get();
        return Datatables::of($fr)->make(true);
    }

    public function insertRn(Request $request) {
        $st = $request['st'];
        $nd = $request['nd'];
        $rd = $request['rd'];
        $id_owner = $request['id_user'];
        
        $rn = Regnum::where('owner', '=', $id_owner)->first();        

        if ($rn) {            
            try {
                $carbon = new Carbon();                
                
                $rn->rn = $st."-".$nd;
                $rn->granted_at = $carbon;
                $rn->expired_at = $carbon->addYear(1);
                $rn->save();
                
                $deleted = true;
                $deletedMsg = "National Registration Number for " . $rn->user->name . " is set";
            }catch(\Exception $e){
                $deleted = false;
                $deletedMsg = "Error while executing command";                
            }        
        } else {
            $deleted = false;
            $deletedMsg = "Data is not available";            
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
    // asdad

    function detail1($id) {
        //detail 1 
        $qg1 = Form_question_group::where('name', 'like', '%Pendaftaran%')->first();
        $q1 = Form_question::where('group_question', '=', $qg1->id)->pluck('id');
        $detail1 = Form_result::                    
                    where('id_user', '=', $id)
                    ->whereIn('id_question', $q1)
                    ->get();

        return $detail1;
    }

    function detail2($id) {
        //detail 2
        $detail2 = Form_result::                
                where('id_user', '=', $id)                
                ->get();
        $fq = Form_result::
                where('id_user', '=', $id)
                ->where('id_question', '=', "1")
                ->first();
        $qg2 = 0;
        if ($fq) {
            $fq = $fq->answer;
            $btk = Str::upper($fq);
            $fqg = Form_question_group::where('name', 'like', '%'.$btk.'%')->first()->name;
            foreach ($detail2 as $key => $value) {
                if ($value->question_group == $fqg) {
                } else {
                    unset($detail2[$key]);
                }
            }

            $qg2 = Form_question_group::where('name', 'like', '%'.$btk.'%')->first();
        } else {
            $detail2 = [];
        }  

        return $detail2;        
    }

    function detail3($id) {
        //detail 3
        $detail3 = Form_result::                
                where('id_user', '=', $id)                
                ->get();            
        $fqg = Form_question_group::where('name', 'like', '%Tahap 3%')->first()->name;
        $qg3 = Form_question_group::where('name', 'like', '%Tahap 3%')->first();
        foreach ($detail3 as $key => $value) {
            if ($value->question_group == $fqg) {                
            } else {                
                unset($detail3[$key]);
            }
        }
        
        return $detail3;        
    }

    function docs($id) {
        //documents uploded
        $docs = Form_result::                
                where('id_user', '=', $id)                
                ->get();            
        $fqg = Form_question_group::where('name', 'like', '%Upload%')->first()->name;
        $qgd = Form_question_group::where('name', 'like', '%Upload%')->first();
        foreach ($docs as $key => $value) {
            if ($value->question_group == $fqg) {                
            } else {                
                unset($docs[$key]);
            }
        }

        return $docs;
    }

}
