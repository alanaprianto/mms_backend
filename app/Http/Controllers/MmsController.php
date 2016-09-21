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
		return view('mms.home');
    }
}
