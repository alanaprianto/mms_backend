<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Regnum;

class APIController extends Controller
{   
    public function check_rn($rn)
    {
    	$regnum = Regnum::where('regnum', '=', $rn)->first();

    	if (!$regnum||$regnum->regnum=='requested'||$regnum->regnum=='cancelled') {
    		return response()->json(['validity' => false, 'rn' => $rn]);
    	}

    	return response()->json(['validity' => true, 'rn' => $rn]);
    }
}
