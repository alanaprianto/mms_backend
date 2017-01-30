<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Form_result;

class DaerahChartController extends Controller
{
    public function __construct() 
    {
    	if (!Auth::check()) {	    	
            if (Auth::user()->role!=5) {
                $success = false;
            	$msg = "You must be Kadin Daerah to continue!";
            }
            $success = false;
            $msg = "You must signUp!";

            return response()->json(['success' => $success, 'msg' => $msg]);
	    }
    }

    public function sf_stat()
    {
        $terr = Auth::user()->territory;        

        $carbon = new Carbon();
        $monthsago = $carbon->subMonths(6)->month;        

        $labels = array();
        $data_ab = array();
        $data_alb = array();
        
        for ($i=0; $i <7 ; $i++) {
            if ($monthsago==13) {
                $monthsago = 1;
            }
                
            $labels[] = date('F', strtotime("2000-$monthsago-01"));
            $data_ab[] = Form_result::
                        where('alb', '<>', true)
                        ->where('answer_value', '=', $terr)
                        ->whereMonth('created_at', '=', $monthsago)
                        ->count();
            $data_alb[] = Form_result::
                        where('alb', '=', true)
                        ->where('answer_value', '=', $terr)
                        ->whereMonth('created_at', '=', $monthsago)
                        ->count();
                            
            $monthsago++;
        }                

        return response()->json(['success' => true, 'labels' => $labels, 'data_ab' => $data_ab, 'data_alb' => $data_alb]);
    }

    public function member_stat() 
    {
        $terr = Auth::user()->territory;        

        $carbon = new Carbon();
        $monthsago = $carbon->subMonths(6)->month;
        $monthslater = new Carbon();

        $labels = array();
        $data_ab = array();
        $data_alb = array();

        for ($i=0; $i <7 ; $i++) {
            if ($monthsago==13) {
                $monthsago = 1;
            }
                
            $labels[] = date('F', strtotime("2000-$monthsago-01"));
            $data_ab[] = User::where('territory', '=', $terr)
                        ->where('role', '=', '2')
                        ->whereMonth('created_at', '=', $monthsago)
                        ->count();
            $data_alb[] = User::where('territory', '=', $terr)
                        ->where('role', '=', '6')
                        ->whereMonth('created_at', '=', $monthsago)
                        ->count();
                            
            $monthsago++;
        }

        return response()->json(['success' => true, 'labels' => $labels, 'data_ab' => $data_ab, 'data_alb' => $data_alb]);
    }
}
