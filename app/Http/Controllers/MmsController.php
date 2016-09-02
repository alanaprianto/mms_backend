<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;

class MmsController extends Controller
{
    /**
     * Menampilkan Halaman Utama
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {            
    	$contents = "HOME";	
    	if (Request::ajax()) {                       
    		$contents = "HOME (Ajax Request)";
            return view('mms.home-content', compact('contents'));
        }

		return view('mms.home', compact('contents'));
    }
}
