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

class KadinProvinsiController extends Controller
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
        $totalreqkta = Kta::where('kta', '=', 'validated')->whereIn('owner', $owner)->get()->count();
        $totalcancelkta = Kta::where('kta', '=', 'cancelled')->whereIn('owner', $owner)->get()->count();

        return view('provinsi.dashboard.index', compact('notifs', 'totalkta', 'totalreqkta', 'totalcancelkta', 'user'));
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

        $kta = $user->no_kta;

        return view('provinsi.profile.profile', compact('notifs', 'required', 'completed', 'percentage', 'kta'));
    }

    public function ktaRequest()
    {
    	$notifs = \App\Helpers\Notifs::getNotifs();

        $terr = Auth::user()->territory;
        $owner = User::where('territory', 'like', $terr.'%')->where('role', '=', 2)->pluck('id');
        $kta = Kta::where('kta', '=', 'validated')->whereIn('owner', $owner)->get();

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
            $data[] = Kta::where('kta', '=', 'requested')->whereMonth('created_at', '=', $i)->count();            
        }


    	return view('provinsi.kta.request.index', compact('notifs', 'kta', 'labels', 'data'));
    }

    public function ajaxKta() {
        $terr = Auth::user()->territory;
        $kta = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->where('kta', '=', 'validated')->pluck('owner');

        $fr = Form_result::leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('id_question', '=', '8')
                ->whereIn('id_user', $kta)                
                ->get();
        return Datatables::of($fr)->make(true);
    }

    public function ktaRequestDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        
        $detail1 = $this->detail1($member->id);
        $detail2 = $this->detail2($member->id);
        $detail3 = $this->detail3($member->id);
        $docs = $this->docs($member->id);

        return view('provinsi.kta.request.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
    }

    public function cancelKta(Request $request) {        
        $keterangan = $request['keterangan'];        
        $id_owner = $request['id_user'];

        $kta = Kta::where('owner', '=', $id_owner)->first();        
        
        if ($kta) {
            try {
                $kta->kta = "cancelled";
                $kta->keterangan = $keterangan;
                $kta->save();

                $deleted = true;
                $deletedMsg = "KTA request from " . $kta->user->name . " is cancelled";      
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

    public function ktaCancel() {
        $notifs = \App\Helpers\Notifs::getNotifs();

        $terr = Auth::user()->territory;
        $owner = User::where('territory', 'like', $terr.'%')->where('role', '=', 2)->pluck('id');
        $kta = Kta::where('kta', '=', 'cancelled')->whereIn('owner', $owner)->get();

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
            $data[] = Kta::where('kta', '=', 'cancelled')->whereMonth('created_at', '=', $i)->count();            
        }

        return view('provinsi.kta.canceled.index', compact('notifs', 'kta', 'labels', 'data'));
    }

    public function ajaxKtaCancel() {
        $terr = Auth::user()->territory;
        $kta = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->where('kta', '=', 'cancelled')->pluck('owner');

        $fr = Form_result::where('id_question', '=', '8')
                ->whereIn('id_user', $kta)                
                ->get();
        return Datatables::of($fr)->make(true);
    }

    public function ktaCancelDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        
        $detail1 = $this->detail1($member->id);
        $detail2 = $this->detail2($member->id);
        $detail3 = $this->detail3($member->id);
        $docs = $this->docs($member->id);

        return view('provinsi.kta.canceled.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
    }

    public function insertKta(Request $request) {
        $st = $request['st'];
        $nd = $request['nd'];
        $rd = $request['rd'];
        $id_owner = $request['id_user'];

        $kta = Kta::where('owner', '=', $id_owner)->first();

        if ($kta) {            
            try {
                $carbon = new Carbon();
                
                $kta->kta = $st."-".$nd."/".$rd;
                $kta->kta = $st."-".$nd;
                $kta->granted_at = $carbon;
                $kta->expired_at = $carbon->addYear(1);
                $kta->save();

                $rn = new Regnum();
                $rn->owner = $id_owner;
                $rn->regnum = 'requested';
                $rn->requested_at = new Carbon();
                $rn->granted_at = "";
                $rn->save();
                
                $deleted = true;
                $deletedMsg = "KTA for " . $kta->user->name . " is set";
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

    public function ktaList()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        $terr = Auth::user()->territory;
        $owner = User::where('territory', 'like', $terr.'%')->where('role', '=', 2)->pluck('id');        
        $kta = Kta::where('kta', '<>', 'requested')->where('kta', '<>', 'cancelled')->whereIn('owner', $owner)->get();

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
            $data[] = Kta::where('kta', '<>', 'requested')
                        ->where('kta', '<>', 'cancelled')
                        ->whereMonth('created_at', '=', $i)
                        ->count();
        }

        return view('provinsi.kta.list.index', compact('notifs', 'kta', 'labels', 'data'));
    }

    public function ajaxKtaList() {
        $terr = Auth::user()->territory;
        $kta = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->where('kta', '<>', 'requested')
            ->where('kta', '<>', 'cancelled')
            ->pluck('owner');

        $fr = Form_result::where('id_question', '=', '8')
                ->whereIn('id_user', $kta)
                ->get();
        $fr = Form_result::leftJoin('kta', 'form_result.id_user', '=', 'kta.owner')
                ->where('form_result.id_question', '=', '8')
                ->whereIn('form_result.id_user', $kta)
                ->get();
        return Datatables::of($fr)->make(true);
    }

    public function ktaListDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);        

        $detail1 = $this->detail1($member->id);
        $detail2 = $this->detail2($member->id);
        $detail3 = $this->detail3($member->id);
        $docs = $this->docs($member->id);

        return view('provinsi.kta.list.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs'));
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
        
        if ($notif->value == "New Request KTA") {            
            return redirect('/dashboard/provinsi/kta/request');
        }
        

    }    

    public function notifall()
    {                           
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
        return view('provinsi.notif.indexall', compact('notifs'));
    }

    public function valnas()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('provinsi.valnas.index', compact('notifs'));
    }

    public function ajaxvalnas() {                
        $rn = Regnum::where('regnum', '=', 'requested')->pluck('owner');
        $fr = User::whereIn('id', $rn)->get();

        return Datatables::of($fr)->make(true);
    }

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