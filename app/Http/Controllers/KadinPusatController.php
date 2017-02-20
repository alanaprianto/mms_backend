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
use Illuminate\Support\Collection;

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

        if (str_contains($notif->value, 'KTA Extension')) {
            $notif->active=false;
            $notif->save();

            return redirect('pusat/ktaext');
        }        
        
        return redirect('pusat/dashboard');
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
        for ($i=0; $i <7 ; $i++) {
            if ($monthsago==13) {
                $monthsago = 1;
            }
                
            $labels[] = date('F', strtotime("2000-$i-01"));
            $data[] = Regnum::where('regnum', '<>', 'requested')
                        ->where('regnum', '<>', 'cancelled')
                        ->whereMonth('created_at', '=', $i)
                        ->count();
                            
            $monthsago++;
        }    
        // for ($i=$monthsago; $i != $monthslater->month+1 ; $i++) { 
        //     if ($i==12) {
        //         $i = 0;
        //     }
        // }

        return view('pusat.rn.list.index', compact('notifs', 'rn', 'labels', 'data'));
    }

    public function ajaxRnList() {                
        $regnums = Regnum::where('regnum', '<>', 'requested')
                ->where('regnum', '<>', 'cancelled')->pluck('owner');
        
        $dt = new Collection;
        foreach ($regnums as $key => $id) {
            $member = User::where('id', '=', $id)->first();

            if ($member->role==2) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '8')->first();
            } else if ($member->role==6) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '96')->first();
            }

            $regnum = Regnum::where('owner', '=', $id)->first();

            $dt->push([
                'id_user' => $id,
                'answer' => $fr->answer,
                'created_at' => $regnum->created_at,
                'granted_at' => $regnum->granted_at,
                'regnum' => $regnum->regnum,
            ]);
        }

        return Datatables::of($dt)->make(true);
    }

    public function ajaxRnList1() {
        $regnums = Regnum::where('regnum', '<>', 'requested')
                ->where('regnum', '<>', 'cancelled')->pluck('owner');

        $cl = new Collection;
        foreach ($regnums as $key => $id) {
            $member = User::find($id);

            if ($member->role==2) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '8')->first();
            } else if ($member->role==6) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '96')->first();
            }

            $alb = false;
            if ($fr->alb) {
                $alb = $fr->alb;
            }

            $regnum = Regnum::where('owner', '=', $id)->first();
            $cl->push([
                'id_user' => $id,
                'answer' => $fr->answer,
                'created_at' => $regnum->created_at->format('Y-m-d H:i:s'),
                'granted_at' => $regnum->granted_at,
                'alb' => $alb,
                'regnum' => $regnum->regnum,
            ]);
        }

        return Datatables::of($cl)->make(true);
    }

    public function rnListDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);        
        $trackingcode = Form_result::where('id_user', '=', $member->id)->get();

        if (!$trackingcode[0]->alb) {
            $detail1 = $this->detail1($member->id);
            $detail2 = $this->detail2($member->id);
            $detail3 = $this->detail3($member->id);
            $docs = $this->docs($member->id);
        } else {
            $detail1 = $trackingcode;
            $detail2 = new Collection;
            $detail3 = new Collection;
            $docs = new Collection;
        }
        $trackingcode = $trackingcode[0]->trackingcode;

        return view('pusat.rn.list.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs', 'trackingcode'));
    }

    public function rnRequestDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);        
        $trackingcode = Form_result::where('id_user', '=', $member->id)->get();

        if (!$trackingcode[0]->alb) {
            $detail1 = $this->detail1($member->id);
            $detail2 = $this->detail2($member->id);
            $detail3 = $this->detail3($member->id);
            $docs = $this->docs($member->id);
        } else {
            $detail1 = $trackingcode;
            $detail2 = new Collection;
            $detail3 = new Collection;
            $docs = new Collection;
        }
        $trackingcode = $trackingcode[0]->trackingcode;

        return view('pusat.rn.request.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs', 'trackingcode'));
    }

    public function rnRequest()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        

        $rn = Regnum::where('regnum', '=', 'requested')->pluck('owner');

        $carbon = new Carbon();
        $monthsago = $carbon->subMonths(6)->month;
        $monthslater = new Carbon();

        $labels = array();
        $data = array();
        for ($i=0; $i <7 ; $i++) {
            if ($monthsago==13) {
                $monthsago = 1;
            }
                
            $labels[] = date('F', strtotime("2000-$monthsago-01"));
            $data[] = Regnum::where('regnum', '=', 'requested')
                        ->whereMonth('created_at', '=', $monthsago)
                        ->pluck('owner')
                        ->count();
                            
            $monthsago++;
        }    
        // for ($i=$monthsago; $i != $monthslater->month+1 ; $i++) { 
        //     if ($i==12) {
        //         $i = 0;
        //     }                    
        // }
        
        return view('pusat.rn.request.index', compact('notifs', 'rn', 'labels', 'data'));
    }

    public function ajaxRnRequest() {
        $regnums = Regnum::where('regnum', '=', 'requested')->pluck('owner');

        $dt = new Collection;
        foreach ($regnums as $key => $rn) {
            $member = User::where('id', '=', $rn)->first();
            
            if ($member->role==2) {
                $id_question = Form_question::where('question', '=', 'Nama Perusahaan')->first()->id;
                $fr = Form_result::where('id_user', '=', $rn)->where('id_question', '=', $id_question)->first();
            } else if ($member->role==6) {
                $id_question = Form_question::where('question', '=', 'Nama Asosiasi/Himpunan')->first()->id;
                $fr = Form_result::where('id_user', '=', $rn)->where('id_question', '=', $id_question)->first();
            }

            $regnum = Regnum::where('owner', '=', $rn)->first();

            $dt->push([
                'id_user' => $rn,
                'name' =>  $member->name,
                'territory' => $member->territory,
                'answer' => $fr->answer,
                'created_at' => $regnum->created_at->format('Y-m-d H:i:s'),
                'role' =>  $member->role,
            ]);
        }
        // $fr = Form_result::leftJoin('users', 'form_result.id_user', '=', 'users.id')
        //         ->where('id_question', '=', '8')
        //         ->whereIn('id_user', $rn)                
        //         ->get();
        
        return Datatables::of($dt)->make(true);
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
                
                $rn->regnum = $st."-".$nd;
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
    
    public function ktaExt()
    {                       
        $notifs = \App\Helpers\Notifs::getNotifs();        

        return view('pusat.ktaext.index', compact('notifs'));
    }

    public function ajaxKtaExtension() {                
        $ktas = Kta::where('perpanjangan', '=', 'requested')->get();
        
        $fr = new Collection;
        $today = new Carbon();
        foreach ($ktas as $key => $value) {
            $exp = Carbon::parse($value->expired_at);
            $exp_month = $exp->diffInMonths($today);

            if ($exp_month<=3||$today >= $exp) {
                $exp_show = true;                

                $exp_at = $exp_month;
                if ($exp_month==0) {
                    $exp_at = $exp->diffInDays($today);

                    if ($exp_at==1) {
                        $m = "Day";
                    } else {
                        $m = "Days";
                    }
                } else {
                    if ($exp_at==1) {
                        $m = "Month";
                    } else {
                        $m = "Months";
                    }
                }                

                $exp_in = "";
                if ($today >= $exp) {
                    $exp_in = $exp_at." ".$m." Ago";
                } else if ($exp_at<=3) {
                    $exp_in = "In ".$exp_at." ".$m;
                }

                $comp = Form_result::where('id_user', '=', $value->owner)
                            ->where('id_question', '=', '8')
                            ->first()->answer_value;
                $comptype = Form_result::where('id_user', '=', $value->owner)
                            ->where('id_question', '=', '1')
                            ->first()->answer;
                $comprep = $value->user->name;
                $kta = $value->kta;
                $id_user = $value->owner;
                $exp_at = $value->expired_at;
                $stat = $value->perpanjangan;
                $id = $value->id;

                $fr->push([
                    'id' => $id,
                    'company' => $comptype." ".$comp,
                    'companyrep' => $comprep,
                    'kta' => $kta,
                    'expired_at' => $exp_at,
                    'expired_in' => $exp_in,
                    'id_user' =>  $id_user,
                    'status' => $stat,
                ]);
            }      
        }

        return Datatables::of($fr)->make(true);
    }

    public function memberDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        $trackingcode = Form_result::where('id_user', '=', $member->id)->get();

        if (!$trackingcode[0]->alb) {
            $detail1 = $this->detail1($member->id);
            $detail2 = $this->detail2($member->id);
            $detail3 = $this->detail3($member->id);
            $docs = $this->docs($member->id);
        } else {
            $detail1 = $trackingcode;
            $detail2 = new Collection;
            $detail3 = new Collection;
            $docs = new Collection;
        }
        $trackingcode = $trackingcode[0]->trackingcode;

        return view('pusat.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs', 'trackingcode'));
    }    

    public function ktaExtensionProcess(Request $request) {
        $id = $request['id_kta'];
        $name = $request['compname'];


        try {            
            $kta = Kta::where('id', '=', $id)->first();            
            $pp = 'processed_'.$kta->kta;

            $kta->update([
                    'kta' => 'requested',
                    'perpanjangan' => $pp,
                ]);            

            $deleted = true;
            $deletedMsg = "Extension Request from ".$name." is Proceeded";
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while executing command";
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
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
