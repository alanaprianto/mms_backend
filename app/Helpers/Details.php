<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Form_question_group;
use App\Form_question;
use App\Form_result;

class Details
{        
    public static function detail1($id) {
        //detail 1 
        $qg1 = Form_question_group::where('name', 'like', '%Pendaftaran%')->first();
        $q1 = Form_question::where('group_question', '=', $qg1->id)->pluck('id');
        $detail1 = Form_result::
                    where('id_user', '=', $id)
                    ->whereIn('id_question', $q1)
                    ->get();

        // select( 'form_result.*',
        //             DB::raw('(select order from form_question where id = form_result.id_question) as order') )
        return $detail1;
    }

    public static function detail2($id) {
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

    public static function detail3($id) {
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

    public static function docs($id) {
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
