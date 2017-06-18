<?php

namespace App\Http\Controllers\Alb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kta;
use Illuminate\Support\Facades\Auth;
use App\Regnum;
use App\Form_type;
use App\Form_question;
use App\Form_result;
use App\Form_question_group;
use Carbon\Carbon;
use App\User;
use Datatables;

class AlbController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {                       
    	$notifs = \App\Helpers\Notifs::getNotifs();        
    	$member = Auth::user();
    	$detail = Form_result::                    
                    where('id_user', '=', $member->id)
                    ->get();

    	$kta = Kta::where('owner', '=', $member->id)->first();
        $exp_show = false;
        $exp_text1 = "";
        $exp_text2 = "";
        if ($kta) {
            $kta = $member->kta->first()->kta;

            if ($kta=="") {
            } else if ($kta=="requested") {                
            } else if ($kta=="validated") {                
            } else if ($kta=="cancelled") {                
            } else {                
                $today = new Carbon();
                $exp = Carbon::parse($member->kta->first()->expired_at);

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
                    
                    if ($today >= $exp) {
                        $exp_text1 = "Your KTA is Expired";
                        $exp_text2 = $exp_at." ".$m." Ago";
                    } else if ($exp_month<=3) {                    
                        $exp_text1 = "Your KTA will be Expired";
                        $exp_text2 = "In ".$exp_at." ".$m;
                    }
                }
            }            
        } else {
            $kta = "";            
        }

        $rn = Regnum::where('owner', '=', $member->id)->first();
        if ($rn) {
            $rn = $member->regnum->regnum;
        } else {
            $rn = "";
        }

        $pdoc = Form_question_group::where('name', 'like', '%Anggota Luar Biasa%')->first()->id;        
        $idoc = Form_type::where('name', 'like', '%File Upload%')->first()->id;
        $qdoc = Form_question::where('type', '=', $idoc)->where('group_question', '=', $pdoc);
        $rdoc = $qdoc->count();
        $fdoc = Form_result::where('id_user', '=', $member->id)->whereIn('id_question', $qdoc->pluck('id'));
        $cdoc = $fdoc->count();
        $docs = $fdoc->get();

        $results = Form_result::where('id_user', '=', $member->id)->get();
        $nasosiasi = "";
        $tingkat = "";        
        $daerah = "";
        $provinsi = "";
        foreach ($results as $key => $result) {
            $question = $result->question;
            if (str_contains($question, "Nama Asosiasi/Himpunan")) {
                $nasosiasi = $result->answer;
            } else if (str_contains($question, "Tingkat")) {
                $tingkat = $result->answer;
            } else if (str_contains($question, "Kabupaten / Kota")) {
                $daerah = $result->territory_name;
            } else if (str_contains($question, "Provinsi")) {
                $provinsi = $result->territory_name;
            }
        }

        $comm = Form_result::where('id_user', '=', $member->id)->where('commentary', '!=', '')->count();
        $corr = Form_result::where('id_user', '=', $member->id)->where('correction', '!=', '')->count();
        
        $chat = false;
        if ($member->chat_acc=='created') $chat = true;

        return view('alb.dashboard.index', compact('notifs', 'member', 'kta', 'exp_show', 'exp_text1', 'exp_text2', 'rn', 
        		'cdoc', 'rdoc', 'docs', 'detail', 'nasosiasi', 'tingkat', 'daerah', 'provinsi', 'comm', 'corr', 'chat'));
    }

    public function kta()
    {                       
        $user = Auth::user();          

        $thekta = Kta::where('owner', '=', $user->id)->first();
        if ($thekta) {
            $kta = $user->kta->first()->kta;

            $today = new Carbon();
            $exp = Carbon::parse($user->kta->first()->expired_at);

            $exp_month = $exp->diffInMonths($today);

            $exp_show = false;
            if ($exp_month<=3||$today >= $exp) {
                $exp_show = true;

                $exp_at = $exp_month;
                if ($exp_month==0) {
                    $exp_at = $exp->diffInDays($today);

                    $m = "Hari";                
                } else {
                    $m = "Bulan";                
                }                
                if ($today >= $exp) {
                    $exp_text1 = "Masa Berlaku KTA anda telah habis. Segera perpanjang KTA anda untuk terus menikmati layanan anggota Kadin.";
                    $exp_text2 = "Masa berlaku KTA anda telah habis sejak ";
                    $exp_text3 = $exp_at." ".$m." Lalu";
                } else if ($exp_month<=3) {
                    $exp_text1 = "Masa Berlaku KTA anda telah berada di masa tenggang.";
                    $exp_text2 = "Kartu Tanda Anggota Anda tidak akan berlaku dalam ";
                    $exp_text3 = $exp_at." ".$m;
                }
            }
            
            $ext_show = true;
            if ($thekta->perpanjangan=="requested") {
                $ext_show = false;
            }
        } else {
            $kta = "";
        }        

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('alb.kta.index', compact('notifs', 'kta', 'exp_show', 'exp_text1', 'exp_text2', 'exp_text3',
                'ext_show'));
    }

    public function regnum()
    {                       
        $user = Auth::user();          

        $rn = Regnum::where('owner', '=', $user->id)->first();        
        if ($rn) {
            $rn = $user->regnum->regnum;
        } else {
            $rn = "";
        }        

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('alb.rn.index', compact('notifs', 'rn'));
    }

    public function compprof()
    {                               
        $notifs = \App\Helpers\Notifs::getNotifs();

        $member = Auth::user();
        $detail = Form_result::                    
                    where('id_user', '=', $member->id)
                    ->get();
        $trackingcode = Form_result::where('id_user', '=', $member->id)->first()->trackingcode;
        $fileqg = Form_type::where('name', 'like', '%File Upload%')->pluck('id');
        $fileq = Form_question::whereIn('type', $fileqg)->pluck('id')->toArray();

        $show = true;
        $thekta = Kta::where('owner', '=', $member->id)->first();
        if ($thekta) {
            $kta = $member->kta->first()->kta;
            if ($kta=="requested"||$kta=="validated") {
                $show = false;
            } else {
                if ($thekta->perpanjangan=="requested") {
                    $show = false;
                }
            }
        }

        return view('alb.compprof.index', compact('notifs', 'member', 'show', 'detail', 'trackingcode', 'fileq'));
    }

    public function requestkta(Request $request) {
        $user = Auth::user();
        $type = $request['type'];

        $pdoc = Form_question_group::where('name', 'like', '%Anggota Luar Biasa%')->first()->id;        
        $idoc = Form_type::where('name', 'like', '%File Upload%')->first()->id;
        $qdoc = Form_question::where('type', '=', $idoc)->where('group_question', '=', $pdoc);
        $rdoc = $qdoc->count();
        $fdoc = Form_result::where('id_user', '=', $user->id)->whereIn('id_question', $qdoc->pluck('id'));
        $cdoc = $fdoc->count();        

        $results = Form_result::where('id_user', '=', $user->id)->get();                

        $orgname = "";
        $orglead = "";
        $orgaddr = "";
        $orgclass = "";
		$postcode = "";
		$kblicode = "";        
        $provinsi = "";
        foreach ($results as $key => $result) {
            $question = $result->question;
            if (str_contains($question, "Nama Asosiasi/Himpunan")) {
                $orgname = $result->answer;
            } else if (str_contains($question, "Nama Pimpinan Organisasi")) {
                $orglead = $result->answer;
            } else if (str_contains($question, "Alamat Lengkap")) {
                $orgaddr = $result->answer;
            } else if (str_contains($question, "Bidang Usaha 1")) {
                $orgclass = $result->answer;            
            } else if (str_contains($question, "Kode Pos")) {
                $postcode = $result->answer;
            } else if (str_contains($question, "KBLI 1")) {
                $kblicode = $result->answer;            
            } else if (str_contains($question, "Provinsi")) {
                $provinsi = $result->territory_name;
            }
        }

        if ($rdoc!=$cdoc) {            
            return response()->json(['success' => false, 'msg' => "Please complete Uploading required documents!"]);
        }
        if ($orgname=="") {
            return response()->json(['success' => false, 'msg' => "Field 'Nama Asosiasi/Himpunan' is required!"]);
        }
        if ($orglead=="") {
            return response()->json(['success' => false, 'msg' => "Field 'Nama Pimpinan Organisasi' is required!"]);
        }
        if ($orgaddr=="") {
            return response()->json(['success' => false, 'msg' => "Field 'Alamat Lengkap' is required!"]);
        }
        if ($orgaddr=="") {
            return response()->json(['success' => false, 'msg' => "Field 'Bidang Usaha 1' is required!"]);
        }
        if ($postcode=="") {
            return response()->json(['success' => false, 'msg' => "Field 'Kode Pos' is required!"]);
        }
        if ($kblicode=="") {
            return response()->json(['success' => false, 'msg' => "Field 'KBLI 1' is required!"]);
        }        
        if ($provinsi=="") {
            return response()->json(['success' => false, 'msg' => "Field 'Provinsi' is required!"]);
        }

        try {
            $kta = Kta::where('owner', '=', $user->id)->first();

            if ($kta) {
                if ($type=="reqpostkta") {
                    $kta->owner = $user->id;
                    $kta->kta = 'requested';
                    $kta->requested_at = new Carbon();
                    $kta->granted_at = "";
                    $kta->save();

                    $idSender = Auth::user()->id;
                    $idDaerah = Auth::user()->territory;
                    $daerah = User::where('role', '=', '5')->where('territory', '=', $idDaerah)->get();
                    foreach ($daerah as $key => $d) {
                        \App\Helpers\Notifs::create($d->id, $idSender, null, "New KTA Request");
                    }
                    \App\Helpers\Notifs::create($user->id, $user->id, null, "KTA Request is Sent");

                    $deleted = true;
                    $deletedMsg = "KTA Request is Sent";
                } else {
                    $deleted = false;
                    $deletedMsg = "Your KTA is Already Generated";
                }
            } else {
                $kta = new Kta;
                $kta->owner = $user->id;
                $kta->kta = 'requested';
                $kta->requested_at = new Carbon();
                $kta->granted_at = "";
                $kta->save();

                $idSender = Auth::user()->id;
                $idDaerah = Auth::user()->territory;
                $daerah = User::where('role', '=', '5')->where('territory', '=', $idDaerah)->get();
                foreach ($daerah as $key => $d) {
                    \App\Helpers\Notifs::create($d->id, $idSender, null, "New KTA Request");
                }
                \App\Helpers\Notifs::create($user->id, $user->id, null, "KTA Request is Sent");

                $deleted = true;
                $deletedMsg = "KTA Request is Sent";
            }
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while requesting KTA";
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function ajaxKta() {
        $user = Auth::user();
        $kta = Kta::where('owner', '=', $user->id)->get();

        return Datatables::of($kta)->make(true);
    }

    public function ktaprint(Request $request) {
        $user = Auth::user();
        $kta = $user->kta->first()->kta;
        $rn = $user->regnum->regnum;        
        
        if ($kta==""||$kta=="requested"||$kta=="validated"||$kta=="cancelled") {
            return response()->json(['success' => false, 'msg' => "KTA is not Available!"]);
        }
        if ($rn==""||$rn=="requested"||$rn=="validated"||$rn=="cancelled") {
            return response()->json(['success' => false, 'msg' => "RN Number is not Available!"]);
        }

        return response()->json(['success' => true, 'msg' => "Printing KTA"]);        
    }

    public function printkta()
    {                               
        $user = Auth::user();
        $kta = $user->kta->first()->kta;
        $rn = $user->regnum->regnum;
        $exp = Carbon::parse($user->kta->first()->expired_at)->format('m-d-Y');

        $results = Form_result::where('id_user', '=', $user->id)->get();                

        $compname = "";
        $complead = "";
        $compaddr = "";
        $compbdus = "";
		$postcode = "";
		$kblicode = "";        
        $provinsi = "";
        foreach ($results as $key => $result) {
            $question = $result->question;
            if (str_contains($question, "Nama Asosiasi/Himpunan")) {
                $compname = $result->answer;
            } else if (str_contains($question, "Nama Pimpinan Organisasi")) {
                $complead = $result->answer;
            } else if (str_contains($question, "Alamat Lengkap")) {
                $compaddr = $result->answer;
            } else if (str_contains($question, "Bidang Usaha 1")) {
                $compbdus = $result->answer;            
            } else if (str_contains($question, "Kode Pos")) {
                $postcode = $result->answer;
            } else if (str_contains($question, "KBLI 1")) {
                $kblicode = $result->answer;            
            } else if (str_contains($question, "Provinsi")) {
                $provinsi = $result->territory_name;
            }
        }
        
        return view('alb.kta.print', compact('kta', 'rn', 'exp', 'compname', 'complead', 'compaddr', 'compbdus', 'postcode', 'kblicode', 'provinsi'));
    }

    public function completeprofile()
    {                
        $user = Auth::user();        
        $fqg = Form_question_group::where('name', '=', 'Anggota Luar Biasa')->first();
        $fquestions = Form_question::where('group_question', '=', $fqg->id)->orderBy('group_question', 'asc')->orderBy('order', 'asc')->get();        
        $fresults = Form_result::where('id_user', '=', $user->id)->get();        

        $notifs = \App\Helpers\Notifs::getNotifs();        
        return view('alb.compprof.completeprofile', compact('notifs', 'fquestions', 'fresults', 'fqg'));
    }

}
