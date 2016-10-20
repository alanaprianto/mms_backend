<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_question;
use App\Form_result;
use Carbon\Carbon;

class PercobaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function percobaan()
    {        
        
        $fquestions = Form_question::whereHas('group', function ($q) {        
            $q->where('name', 'like', '%Percobaan%');
        })->orderBy('order', 'asc')->get();
        
        $notifs = null;

        // return view('form.percobaan', compact('fquestions', 'notifs'));

        $random_string = md5(microtime());
        $first = substr($random_string, 0, 4);
        $last = substr($random_string, -4);
        $code = $first.$last;
        $array = [$random_string, $first, $last];        
        // return $code;

        // $code = "d734b7d7";
        // return view('emails.trackingcode', compact('code'));

        $fresult = Form_result::where('id_user', '=', '29')->get();

        // return $fresult;
        
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', '2016-09-29 04:33:52')->diffForHumans();
        // return $datetime;

        $notifs = \App\Helpers\Notifs::getNotifs();
        // return $notifs[0]->crt_human;

        // $code = "ASDADWKWK";
        // return view('emails.trackingcode', compact('code'));

        return view('percobaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function percobaanstore(FormResultRequest $request)
    {                
        $input = $request->all();
        return $input;

        $datas = array();
        foreach ($input as $key => $value) {
            $keys = explode("_", $key);
            $form_result = new formResult;

            try {
                if (!empty($keys[2])) {
                    $form_result->id_question = $keys[2];                    
                    if (is_array($value)) {
                        $form_result->answer_value = implode (", ", $value);
                    } else {
                        $form_result->answer_value = $value;
                    }                    
                    $form_result->id_user = "12";

                    $datas[] = $form_result;
                }
            } catch (\ErrorException $e) {
                
            }              
        }
        //$input = $request->get('id_question');
        
        // return $datas;
        foreach ($datas as $data) {
            // $asdad = json_encode($data);
            // return $asdad;
            // Form_result::create($asdad);

            $fr = new Form_result;

            $fr->id_question = $data->id_question;
            $fr->answer_value = $data->answer_value;
            $fr->id_user = '12';

            $fr->save();                        
        }

        return redirect('/crud/form/result');         
    }
}
