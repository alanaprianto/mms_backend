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
use App\Form_type;

class KadinProvinsiController extends Controller
{
    public function dashboard()
    {                       
    	$notifs = \App\Helpers\Notifs::getNotifs();

        $user = Auth::user();
        $terr = $user->territory;
        $roles = [2, 6];
        $owner = User::where('territory', 'like', $terr.'%')->whereIn('role', $roles)->pluck('id');

        $totalkta = Kta::where('kta', '<>', 'requested')
                    ->where('kta', '<>', 'cancelled')
                    ->whereIn('owner', $owner)
                    ->get()->count();
        $totalreqkta = Kta::where('kta', '=', 'validated')->whereIn('owner', $owner)->get()->count();
        $totalcancelkta = Kta::where('kta', '=', 'cancelled')->whereIn('owner', $owner)->get()->count();

        $ktas = Kta::where('kta', '<>', 'requested')
                    ->where('kta', '<>', 'cancelled')
                    ->whereIn('owner', $owner)
                    ->get();
        $totalexpkta = 0;
        $today = new Carbon();
        foreach ($ktas as $key => $value) {
            $exp = Carbon::parse($value->expired_at);
            $exp_at = $exp->diffInMonths($today);

            if ($exp_at<=3||$today>=$exp) {
                $totalexpkta = $totalexpkta+1;
            }
        }
        
        return view('provinsi.dashboard.index', compact('notifs', 'totalkta', 'totalreqkta', 'totalcancelkta', 'user', 'totalexpkta'));
    }

    public function ktaDetail($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $member = User::find($id);
        $trackingcode = Form_result::where('id_user', '=', $member->id)->first()->trackingcode;

        if ($member->role==2) {
            $detail1 = \App\Helpers\Details::detail1($member->id);
            $detail2 = \App\Helpers\Details::detail2($member->id);
            $detail3 = \App\Helpers\Details::detail3($member->id);
            $docs = \App\Helpers\Details::docs($member->id);        

            return view('provinsi.kta.detail', compact('notifs', 'member', 'detail1', 'detail2', 'detail3', 'docs', 'trackingcode'));
        } elseif ($member->role==6) {
            $fileqg = Form_type::where('name', 'like', '%File Upload%')->pluck('id');
            $fileq = Form_question::whereIn('type', $fileqg)->pluck('id')->toArray();

            $detail = Form_result::                    
                    where('id_user', '=', $member->id)
                    ->get();

            return view('provinsi.kta.detail1', compact('notifs', 'member', 'detail', 'fileq', 'trackingcode'));
        }        
    }

    public function ktaRequest()
    {
    	$notifs = \App\Helpers\Notifs::getNotifs();        

    	return view('provinsi.kta.request.index', compact('notifs'));
    }

    public function ajaxKta() {        
        $terr = Auth::user()->territory;
        $ktas = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->where('kta', '=', 'validated');

        // $fr = Form_result::leftJoin('users', 'form_result.id_user', '=', 'users.id')
        //         ->where('id_question', '=', '8')
        //         ->whereIn('id_user', $ktas->pluck('owner'))
        //         ->get();
        $dt = new Collection;        
        foreach ($ktas->get() as $key => $kta) {            
            if (str_contains($kta->perpanjangan, 'processed')) {
                $status = "Perpanjangan KTA";
            } else {
                $status = "Pembuatan KTA";
            }

            $comp = "";
            $comptype = "";
            $user = User::where('id', '=', $kta->owner)->first();
            if ($user->role==2) {
                $comp = Form_result::where('id_user', '=', $kta->owner)
                        ->where('id_question', '=', '8')
                        ->first()->answer_value;
                $comptype = Form_result::where('id_user', '=', $kta->owner)
                            ->where('id_question', '=', '1')
                            ->first()->answer;
            } elseif ($user->role==6) {
                $comp = Form_result::where('id_user', '=', $kta->owner)
                        ->where('id_question', '=', '96')
                        ->first()->answer_value;
            }            
            $regat = Form_result::where('id_user', '=', $kta->owner)->first()->created_at->format('d/m/Y');

            $dt->push([                    
                    'company' => $comptype." ".$comp,
                    'comprep' => $kta->user->name,
                    'registered_at' => $regat,
                    'id_user' => $kta->owner,
                    'territory' => $kta->user->territory,
                    'status' => $status,
                    'perpanjangan' => $kta->perpanjangan,
                ]);
        }

        return Datatables::of($dt)->make(true);
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

                $ext = str_contains($kta->perpanjangan, 'processed');
                $msg = "KTA Request";
                if ($ext) {
                    $msg = "KTA Extension Request";
                }

                $idSender = Auth::user()->id;
                \App\Helpers\Notifs::create($id_owner, $idSender, null, "Your ".$msg." is Cancelled");

                $deleted = true;
                $deletedMsg = $msg." from " . $kta->user->name . " is Cancelled";
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

        return view('provinsi.kta.canceled.index', compact('notifs'));
    }

    public function ajaxKtaCancel() {
        $terr = Auth::user()->territory;
        $ktas = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->where('kta', '=', 'cancelled')->pluck('owner');
        
        $dt = new Collection;
        foreach ($ktas as $key => $id) {
            $member = User::where('id', '=', $id)->first();

            if ($member->role==2) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '8')->first();
            } else if ($member->role==6) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '96')->first();
            }

            $kta = Kta::where('owner', '=', $id)->first();

            $dt->push([
                'id_user' => $id,
                'answer' => $fr->answer,
                'created_at' => $kta->created_at,
                'updated_at' => $kta->updated_at,                
            ]);
        }

        return Datatables::of($dt)->make(true);

        // $fr = Form_result::where('id_question', '=', '8')
        //         ->whereIn('id_user', $kta)                
        //         ->get();        
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
                
                // $kta->kta = $st."-".$nd."/".$rd;
                $kta->kta = $st."-".$nd;
                $kta->granted_at = $carbon;
                $kta->expired_at = $carbon->addYear(1);
                if (str_contains($kta->perpanjangan, 'processed')) {
                    $kta->perpanjangan = "granted";
                    $kta->save();
                } else {
                    $kta->save();

                    $rn = new Regnum();
                    $rn->owner = $id_owner;
                    $rn->regnum = 'requested';
                    $rn->requested_at = new Carbon();
                    $rn->granted_at = "";
                    $rn->save();
                }

                $ext = str_contains($kta->perpanjangan, 'processed');
                $msg = "KTA Request";
                if ($ext) {
                    $msg = "KTA Extension Request";
                }
                $idSender = Auth::user()->id;
                \App\Helpers\Notifs::create($id_owner, $idSender, null, "Your ".$msg." is Generated");

                $member = User::find($id_owner);
                $pusats = User::where('role', '=', '3')->get();
                foreach ($pusats as $key => $pusat) {
                    \App\Helpers\Notifs::create($pusat->id, $idSender, null, "NR Request from ".$member->username);
                }

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

        return view('provinsi.kta.list.index', compact('notifs'));
    }

    public function ajaxKtaList() {        
        $terr = Auth::user()->territory;
        $ktas = Kta::whereHas('user', function ($query) use($terr) {
                $query->where('territory', 'like', $terr.'%');
            })->where('kta', '<>', 'requested')
            ->where('kta', '<>', 'validated')
            ->where('kta', '<>', 'cancelled')
            ->pluck('owner');

        // return $kta;
        
        $dt = new Collection;
        foreach ($ktas as $key => $id) {
            $member = User::where('id', '=', $id)->first();

            if ($member->role==2) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '8')->first();
            } else if ($member->role==6) {
                $fr = Form_result::where('id_user', '=', $id)->where('id_question', '=', '96')->first();
            }

            $kta = Kta::where('owner', '=', $id)->first();

            $dt->push([
                'id_user' => $id,
                'answer' => $fr->answer,
                'created_at' => $kta->created_at->format('Y-m-d H:i:s'),
                'granted_at' => $kta->granted_at,
                'kta' => $kta->kta,
            ]);
        }

        return Datatables::of($dt)->make(true);

        // $fr = Form_result::leftJoin('kta', 'form_result.id_user', '=', 'kta.owner')
        //         ->where('form_result.id_question', '=', '8')
        //         ->whereIn('form_result.id_user', $kta)
        //         ->get();
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
        
        if (str_contains($notif->value, ["KTA", "Request"])) {
            return redirect('/provinsi/kta/request');
        }

        return redirect('/provinsi/dashboard');
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

    public function ktaExpired()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        
        return view('provinsi.kta.expired.index', compact('notifs'));
    }

    public function ajaxKtaExpired() {
        $terr = Auth::user()->territory;        
        $owner = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->pluck('owner');
        $ktas = Kta::whereIn('owner', $owner)->get();
        
        $fr = new Collection;
        $today = new Carbon();        
        foreach ($ktas as $key => $value) {
            if ($value->expired_at) {
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
                    
                    if ($value->user->role==2) {
                        $comp = Form_result::where('id_user', '=', $value->owner)
                                ->where('id_question', '=', '8')
                                ->first()->answer_value;
                    } else if ($value->user->role==6) {
                        $comp = Form_result::where('id_user', '=', $value->owner)
                                ->where('id_question', '=', '96')
                                ->first()->answer_value;                        
                    }

                    $comprep = $value->user->name;
                    $kta = $value->kta;
                    $id_user = $value->owner;
                    $exp_at = $value->expired_at;

                    $fr->push([
                        'company' => $comp,
                        'companyrep' => $comprep,
                        'kta' => $kta,
                        'expired_at' => $exp_at,
                        'expired_in' => $exp_in,
                        'id_user' =>  $id_user,
                    ]);
                }      
            }            
        }
        
        return Datatables::of($fr)->make(true);
    }

    public function ktaExtension()
    {                       
        $notifs = \App\Helpers\Notifs::getNotifs();        

        return view('provinsi.kta.expired.extension', compact('notifs'));
    }

    public function ajaxKtaExtension() {   
        $terr = Auth::user()->territory;        
        $owner = Kta::whereHas('user', function ($query) use($terr) {
            $query->where('territory', 'like', $terr.'%');
        })->pluck('owner');
        $ktas = Kta::whereIn('owner', $owner)->where('keterangan', '=', 'request_perpanjangan')->get();
        
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
                $comprep = $value->user->name;
                $kta = $value->kta;
                $id_user = $value->owner;
                $exp_at = $value->expired_at;

                $fr->push([
                    'company' => $comp,
                    'companyrep' => $comprep,
                    'kta' => $kta,
                    'expired_at' => $exp_at,
                    'expired_in' => $exp_in,
                    'id_user' =>  $id_user,
                ]);
            }      
        }

        return Datatables::of($fr)->make(true);
    }    
}