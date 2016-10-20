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

class KadinProvinsiController extends Controller
{
    public function dashboard()
    {                       
    	$notifs = \App\Helpers\Notifs::getNotifs();

        return view('provinsi.dashboard.index', compact('notifs'));
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

        $kta = Kta::where('kta', '=', 'requested')->get();

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
        })->where('kta', '=', 'requested')->pluck('owner');

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

        return view('provinsi.kta.request.detail', compact('notifs', 'member'));
    }

    public function cancelKta($id_owner) {
        $kta = Kta::where('owner', '=', $id_owner)->first();
        
        if ($kta) {
            try {
                $kta->kta = "cancelled";
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

        $kta = Kta::where('kta', '=', 'cancelled')->get();

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

        return view('provinsi.kta.canceled.detail', compact('notifs', 'member'));
    }

    public function insertKta(Request $request) {
        $st = $request['st'];
        $nd = $request['nd'];
        $rd = $request['rd'];
        $id_owner = $request['id_user'];

        $kta = Kta::where('owner', '=', $id_owner)->first();
        
        if ($kta) {
            try {
                $kta->kta = $st."-".$nd."/".$rd;
                $kta->granted_at = new Carbon();
                $kta->save();

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

        $kta = Kta::where('kta', '<>', 'requested')->where('kta', '<>', 'cancelled')->get();

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

        return view('provinsi.kta.list.detail', compact('notifs', 'member'));
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
}