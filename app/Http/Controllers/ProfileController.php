<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Datatables;
use App\Form_result;
use Illuminate\Support\Facades\Auth;
use App\Form_question_group;
use Illuminate\Support\Str;
use App\Form_question;
use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
		return view('mms.profile.profile', compact('required', 'completed', 'percentage', 'kta'));
    }

    public function edit()
    {        
		return view('mms.profile.edit');
    }    

    public function indexAjax($id) {
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)                
                ->get();                
        foreach ($fr as $key => $value) {
            if ($value->question_group === null) {
                unset($fr[$key]);
            }
        }
        return Datatables::of($fr)->make(true);
    }

    public function tahapiiAjax($id) {
        $fr = Form_result::                
                where('id_user', '=', $id)                
                ->get();
        
        $user = Auth::user();

        $fq = Form_result::                
                where('id_user', '=', $user->id)                
                ->where('id_question', '=', "1")
                ->first();

        if ($fq) {
            $fq = $fq->answer;

            $btk = Str::upper($fq);        
            $fqg = Form_question_group::where('name', 'like', '%'.$btk.'%')->first()->name;
            
            foreach ($fr as $key => $value) {
                if ($value->question_group == $fqg) {                
                } else {                
                    unset($fr[$key]);
                }
            }
        } else {
            $fq = null;
        }    
        return Datatables::of($fr)->make(true);
    }

    public function tahapiiiAjax($id) {
        $fr = Form_result::                
                where('id_user', '=', $id)                
                ->get();
        
        $user = Auth::user();

        $fqg = Form_question_group::where('name', 'like', '%Tahap 3%')->first()->name;
            
        foreach ($fr as $key => $value) {
            if ($value->question_group == $fqg) {                
            } else {                
                unset($fr[$key]);
            }
        }

        return Datatables::of($fr)->make(true);
    }

    public function requestkta() {
        $user = Auth::user();        

        $user->update([
            'no_kta' => 'requested'
            ]);


        return redirect('profile');
    }
}
