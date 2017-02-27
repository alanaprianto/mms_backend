<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Form_question;
use App\Form_answer;
use DB;
use Illuminate\Support\Collection;
use App\Helpers\RandomColor;
use App\Provinsi;
use App\User;
use Carbon\Carbon;

class AdminChartController extends Controller
{
	public function __construct() 
	{
		if (!Auth::check()) {	    	
            if (Auth::user()->role!=1) {
                $success = false;
            	$msg = "You must be Admin!";
            }
            $success = false;
            $msg = "You must signUp!";

            return response()->json(['success' => $success, 'msg' => $msg]);
	    }

	}

    public function adm_donut() 
    {
    	$color = ['#1ab394', '#1ab394', '#79d2c0', '#bababa', '#d3d3d3'];    		    
	    $idbp = Form_question::where('question', '=', 'Bentuk Perusahaan')->first()->id;
	    $vals = DB::table('form_result')
	    		 ->where('id_question', '=', $idbp)
                 ->select('answer_value', DB::raw('count(*) as value'))
                 ->groupBy('answer_value')
                 ->get();

        $datas = new Collection;        
        foreach ($vals as $key => $val) {
        	$label = Form_answer::where('id', '=', $val->answer_value)->first()->answer;

        	$datas->push([
        			'label' => $label,
        			'data' => $val->value,
        			'color' => $color[$key]
        		]);
        }        

        $datas->push([
        			'label' => 'Asdad 1',
        			'data' => 5,
        			'color' => $color[2]
        		]);

        $datas->push([
        			'label' => 'Asdad 2',
        			'data' => 2,
        			'color' => $color[3]
        		]);

        $datas->push([
        			'label' => 'Asdad 3',
        			'data' => 7,
        			'color' => $color[4]
        		]);
        return response()->json(['success' => true, 'datas' => $datas]);
    }

    public function adm_dblbar() 
    {
    	$prov = Provinsi::get();

    	$datas = new Collection;
    	foreach ($prov as $key => $provinsi) {
    		$ab = User::where('territory', 'LIKE', $provinsi->id.'%')->where('role', '=', 2)->count();
    		$alb = User::where('territory', 'LIKE', $provinsi->id.'%')->where('role', '=', 6)->count();

    		$datas->push([
    				'prov' => $provinsi->provinsi,
    				'ab' => $ab,
    				'alb' => $alb
    			]);
    	}
    	return response()->json(['success' => true, 'datas' => $datas]);
    }

    public function adm_member()
    {
    	$carbon = new Carbon();
      	$thismonth = $carbon->month;
      	$newmember = User::whereIn('role', [2, 6])->whereMonth('created_at', '=', $thismonth)->count();
      	$ttlmember = User::whereIn('role', [2, 6])->count();

      	return response()->json(['success' => true, 'newmember' => $newmember, 'ttlmember' => $ttlmember]);
    }

    public function adm_dynform()
    {
    	$totalsetting = \App\Form_setting::get()->count();
      	$totaltype = \App\Form_type::get()->count();
      	$totalrules = \App\Form_rules::get()->count();
      	$totalquestion = \App\Form_question::get()->count();
      	$totalqgroup = \App\Form_question_group::get()->count();
      	$totalanswer = \App\Form_answer::get()->count();
      	$totalresult = \App\Form_result::get()->count();

      	return response()->json(['success' => true, 'totalsetting' => $totalsetting, 'totaltype' => $totaltype, 'totalrules' => $totalrules, 'totalquestion' => $totalquestion, 'totalqgroup' => $totalqgroup, 'totalanswer' => $totalanswer, 'totalresult' => $totalresult]);      	
    }

    function gen_color(){
        return RandomColor::one(array(
           'luminosity' => 'light',
           'hue' => 'green'
        ));
    }
}
