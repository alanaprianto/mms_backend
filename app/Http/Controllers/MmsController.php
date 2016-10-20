<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Notification;
use App\Form_result;
use App\Http\Requests\FormResultRequest;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Provinsi;
use App\Daerah;
use DB;
use Illuminate\Support\Facades\Auth;

class MmsController extends Controller
{
    /**
     * Menampilkan Halaman Utama
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                	
		// return view('mms.home');

        if (Auth::check()) {
            return view('frontend.index')->with('name', Auth::user()->name)->with('loginRole', Auth::user()->role);
        }
		return view('frontend.index');
    }

    /**
     * Menampilkan Halaman 404 Not Found
     *
     * @return \Illuminate\Http\Response
     */
    public function notfound()
    {                	
		// return view('mms.home');
		return view('frontend.page_404');
    }        

    /**
     * Menampilkan list provinsi
     *
     * @return \Illuminate\Http\Response
     */
    public function listProvinsi()
    {                 
      $prov = Provinsi::get();

      return $prov;
    }

    /**
     * Menampilkan list daerah
     *
     * @return \Illuminate\Http\Response
     */
    public function listDaerah($id)
    {                 
      $daerah = Daerah::where(DB::raw('CAST(id AS TEXT)'), 'like', $id.'%')->get();

      return $daerah;
    }    
}
