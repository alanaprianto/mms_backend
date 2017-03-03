<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Session;

class LoginController extends Controller
{
    /**
     * Display Login Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {                       
		return view('frontpage.login');
    }

    /**
     * Process Login Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {                       
    	// validate the info, create rules for the inputs
		$rules = array(
		    'username'    => 'required', 
		    'password' => 'required|min:3'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return redirect('/')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		}

		// create our user data for the authentication
	    $userdata = array(
	        'username'  => Input::get('username'),
	        'password'  => Input::get('password')
	    );

	    // attempt to do the login
	    if (Auth::attempt($userdata)) {
	        
            if (Auth::user()->role=="1") {
                // return "admin";
                          
                // return view('form.app', compact('notifs'));                              
                return redirect('/admin/dashboard');
            } else if (Auth::user()->role=="2") {                
                // return redirect('/')->with('name', Auth::user()->name)->with('loginRole', Auth::user()->role);
                return redirect('/member/dashboard');
            } else if (Auth::user()->role=="3") {
                return redirect('/pusat/dashboard');
            } else if (Auth::user()->role=="4") {
                return redirect('provinsi/dashboard');
            } else if (Auth::user()->role=="5") {
                return redirect('daerah/dashboard');
            } else if (Auth::user()->role=="6") {
                return redirect('alb/dashboard');
            } else {
                return redirect('/')
                ->withErrors(['message' => 'Invalid Username or Password']) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            }	        

	    } else {        

	        // validation not successful, send back to form        
            return redirect('/login')
                ->withErrors(['message' => 'Invalid Username or Password']) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            
	    }
    }

    /**
     * Process Logout Request.
     * flushing session.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {                       
    	Auth::logout();
        Session::flush();

        return redirect('/');
    }    
}
