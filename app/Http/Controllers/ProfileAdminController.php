<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
    	$name = $user->name;
        $email = $user->email;        
        $username = $user->username;     

    	$notifs = \App\Helpers\Notifs::getNotifs();

        if (Auth::user()->role==1) {
            return view('form.profile.index', compact('notifs', 'name', 'email', 'username'));
        } else if (Auth::user()->role==2) {
            return view('member.profile.index', compact('notifs', 'name', 'email', 'username'));
        } else if (Auth::user()->role==3) {
            //pusat
        } else if (Auth::user()->role==4) {
            return view('provinsi.profile.index', compact('notifs', 'name', 'email', 'username'));
        } else if (Auth::user()->role==5) {
            return view('daerah.profile.index', compact('notifs', 'name', 'email', 'username'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCAI(Request $request, $id)
    {            	
        $uname = $request['username'];
        $unameexist = User::where('username', '=', $uname)->first();

        if ($unameexist) {
            $deleted = false;
            $deletedMsg = "The Username is Exist!";
        } else {
            try {
                $user = User::findOrFail($id);
                $user->update($request->all());
                $deleted = true;
                $deletedMsg = "Your Account is Updated";
            }catch(\Exception $e){
                $deleted = false;
                $deletedMsg = "Error while Updating Your Account!";
            }
        }        
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function updateCYP(Request $request, $id)
    {       
    	$opass = $request['oldpassword'];
    	$npass = $request['newpassword'];
    	$cpass = $request['confirmpassword'];

    	if ($npass!=$cpass) {
    		$deleted = false;
            $deletedMsg = "New Password didn't Match!";
    	} else {
    		try {
	        	$user = User::findOrFail($id);
	        	if (Hash::check($opass, $user->password)) {
	        		$user->password = Hash::make($npass);
	        		$user->save();
	        		
	        		$deleted = true;
	            	$deletedMsg = "Your Account Password is Updated";
	        	} else {

	        		$deleted = false;
            		$deletedMsg = "The Old Password is not Correct!";            		
	        	}	            
	        }catch(\Exception $e){
	            $deleted = false;
	            $deletedMsg = "Error while Updating Your Account Password!";
	        }
    	}        
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
