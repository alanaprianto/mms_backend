<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
		return view('mms.profile.profile');
    }

    public function edit()
    {        
		return view('mms.profile.edit');
    }
}
