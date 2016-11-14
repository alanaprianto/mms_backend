<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Form_result;
use Illuminate\Support\Str;
use App\Form_question_group;
use App\Form_question;

class Member1Controller extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {                       
    	$notifs = \App\Helpers\Notifs::getNotifs();
        return view('member.dashboard.index', compact('notifs'));
    }

    public function kta()
    {                       
        $user = Auth::user();          

        if ($user->kta) {
            $kta = $user->kta->kta;
        } else {
            $kta = "";
        }

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('member.kta.index', compact('notifs', 'kta'));
    }

    public function compprof()
    {                       
        $user = Auth::user();
        $fr = Form_result::                
                where('id_user', '=', $user->id)                
                ->where('id_question', '=', "1")
                ->first();

        $required = 0;
        $percentage = 0;
        $completed = 0;

        if ($fr) {
            $comp = $fr->answer;
            $btk = Str::upper($comp);

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

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('member.compprof.index', compact('notifs', 'required', 'completed', 'percentage'));
    }
}
