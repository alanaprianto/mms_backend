<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Form_result;
use App\Kta;

class ProvinsiChartController extends Controller
{
	public function __construct() 
    {
    	if (!Auth::check()) {	    	
            if (Auth::user()->role!=4) {
                $success = false;
            	$msg = "You must be Kadin Provinsi to continue!";
            }
            $success = false;
            $msg = "You must signUp!";

            return response()->json(['success' => $success, 'msg' => $msg]);
	    }
    }

    public function kta_stat()
    {
        $terr = Auth::user()->territory;
        $owner = User::where('territory', 'like', $terr.'%')->whereIn('role', [2, 6])->pluck('id');        
        $kta = Kta::where('kta', '<>', 'requested')->where('kta', '<>', 'validated')->where('kta', '<>', 'cancelled')->whereIn('owner', $owner)->get();

        $carbon = new Carbon();
        $monthsago = $carbon->subMonths(6)->month;
        $monthslater = new Carbon();

        $labels = array();
        $data_gen = array();
        $data_req = array();
        $data_cncl = array();
        $data_exp = array();

        for ($i=0; $i <7 ; $i++) {
            if ($monthsago==13) {
                $monthsago = 1;
            }
                
            $labels[] = date('F', strtotime("2000-$monthsago-01"));
            $data_gen[] = Kta::where('kta', '<>', 'requested')
                        ->where('kta', '<>', 'cancelled')
                        ->whereMonth('created_at', '=', $monthsago)
                        ->count();
            $data_req[] = Kta::where('kta', '=', 'validated')->whereMonth('created_at', '=', $monthsago)->count();
			$data_cncl[] = Kta::where('kta', '=', 'cancelled')->whereMonth('created_at', '=', $monthsago)->count();

            $monthsago++;
        }

        return response()->json(['success' => true, 'labels' => $labels, 'data_gen' => $data_gen, 'data_req' => $data_req, 'data_cncl' => $data_cncl]);
    }
}
