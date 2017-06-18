<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Form_question;
use App\Form_question_group;
use App\Form_result;
use App\Http\Requests;
use App\Kta;
use App\User;
use Carbon\Carbon;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $name = $user->name;
        $email = $user->email;
        $username = $user->username;

        $notifs = \App\Helpers\Notifs::getNotifs();

        $user_caption = '';
        if (Auth::user()->role==1) {
            $user_caption = 'Admin';
        } else if (Auth::user()->role==2) {
            $user_caption = 'Member';
        } else if (Auth::user()->role==3) {
            $user_caption = 'Kadin Indonesia';
        } else if (Auth::user()->role==4) {
            $user_caption = 'Kadin Provinsi';
        } else if (Auth::user()->role==5) {
            $user_caption = 'Kadin Daerah';
        } else if (Auth::user()->role==6) {
            $user_caption = 'Extraordinary Member';
        }

        return view('common.profile.index', compact('notifs', 'name', 'email', 'username', 'user_caption'));
    }

    public function updateCAI(Request $request, $id)
    {
        $uname = $request['username'];
        $unameexist = User::where('username', '=', $uname)->where('id', '<>', $id)->first();

        if ($unameexist) {
            $deleted = false;
            $deletedMsg = "The Username Exist!";
        } else {
            try {
                $user = User::findOrFail($id);

                if ($user->username!=$uname) {
                    $pathold = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/';
                    $pathnew = storage_path() . '/app/uploadedfiles/'.$uname.'/';
                    \File::copyDirectory($pathold, $pathnew);
                    \File::deleteDirectory($pathold);
                }

                $name = "";
                $ext = "";
                $file = storage_path() . '/app/photoprofile'.'/';
                $filesInFolder = \File::files($file);

                foreach($filesInFolder as $path)
                {
                    $files = pathinfo($path);
                    if ($files['filename'] == Auth::user()->username) {
                        $name = $files['filename'];
                        $ext = $files['extension'];

                        $imgold = storage_path() . '/app/photoprofile'.'/'.$name.'.'.$ext;
                        $imgnew = storage_path() . '/app/photoprofile'.'/'.$uname.'.'.$ext;
                        \File::move($imgold, $imgnew);
                    }
                }

                $name = $request['name'];
                $email = $request['email'];
                $uname = $request['username'];
                $updtChat = \App\Helpers\Collaboration::updtCAI($name, $email, $uname, $user->username);
                $user->update($request->all());

                $deleted = true;
                $deletedMsg = "Your Account is Updated";
            } catch(\GuzzleHttp\Exception\ClientException $e) {
                $user = User::findOrFail($id);

                if ($user->username!=$uname) {
                    $pathold = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/';
                    $pathnew = storage_path() . '/app/uploadedfiles/'.$uname.'/';
                    \File::copyDirectory($pathold, $pathnew);
                    \File::deleteDirectory($pathold);
                }

                $name = "";
                $ext = "";
                $file = storage_path() . '/app/photoprofile'.'/';
                $filesInFolder = \File::files($file);

                foreach($filesInFolder as $path)
                {
                    $files = pathinfo($path);
                    if ($files['filename'] == Auth::user()->username) {
                        $name = $files['filename'];
                        $ext = $files['extension'];

                        $imgold = storage_path() . '/app/photoprofile'.'/'.$name.'.'.$ext;
                        $imgnew = storage_path() . '/app/photoprofile'.'/'.$uname.'.'.$ext;
                        \File::move($imgold, $imgnew);
                    }
                }

                $name = $request['name'];
                $email = $request['email'];
                $uname = $request['username'];
                \App\Helpers\Collaboration::updtCAI($name, $email, $uname, $user->username);
                $user->update($request->all());

                $deleted = true;
                $deletedMsg = "Your Account is Updated";
            } catch(\Exception $e){
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

                    \App\Helpers\Collaboration::updtCYP($npass, $user->username);

                    $deleted = true;
                    $deletedMsg = "Your Account Password is Updated";
                } else {

                    $deleted = false;
                    $deletedMsg = "The Old Password is not Correct!";
                }
            } catch(\GuzzleHttp\Exception\ClientException $e) {
                $user = User::findOrFail($id);
                if (Hash::check($opass, $user->password)) {
                    $user->password = Hash::make($npass);
                    $user->save();

                    \App\Helpers\Collaboration::updtCYP($npass, $user->username);

                    $deleted = true;
                    $deletedMsg = "Your Account Password is Updated";
                } else {

                    $deleted = false;
                    $deletedMsg = "The Old Password is not Correct!";
                }
            } catch(\Exception $e){
                return $e;
                $deleted = false;
                $deletedMsg = "Error while Updating Your Account Password!";
            }
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function indexAjax($id) {
        $fr = Form_result::
                leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.id_user', '=', $id)                
                ->get();
        foreach ($fr as $key => $value) {
            if ($value->question_group === null) {
                unset($fr[$key]);
            }
        }
        return Datatables::of($fr)->make(true);
    }

    public function tahapiiAjax($id) {
        $fr = Form_result::                
                where('id_user', '=', $id)                
                ->get();
        
        $user = Auth::user();

        $fq = Form_result::                
                where('id_user', '=', $user->id)                
                ->where('id_question', '=', "1")
                ->first();

        if ($fq) {
            $fq = $fq->answer;

            $btk = Str::upper($fq);
            $fqg = Form_question_group::where('name', 'like', '%'.$btk.'%')->first()->name;
            
            foreach ($fr as $key => $value) {
                if ($value->question_group == $fqg) {
                } else {
                    unset($fr[$key]);
                }
            }
        } else {
            $fq = null;
        }
        return Datatables::of($fr)->make(true);
    }

    public function tahapiiiAjax($id) {
        $fr = Form_result::                
                where('id_user', '=', $id)                
                ->get();
        
        $user = Auth::user();

        $fqg = Form_question_group::where('name', 'like', '%Tahap 3%')->first()->name;
            
        foreach ($fr as $key => $value) {
            if ($value->question_group == $fqg) {                
            } else {                
                unset($fr[$key]);
            }
        }

        return Datatables::of($fr)->make(true);
    }

    public function crtCollaboration(Request $request, $id) {        
        $pass = $request['password'];
        $cpass = $request['confirmpassword'];        
        
        $stack = '';
        if ($pass!=$cpass) {
            $scc = false;
            $msg = "Password didn't Match!";
        } else {
            try {
                $user = User::findOrFail($id);
                if (Hash::check($pass, $user->password)) {
                    $name = $request['name'];
                    $username = $request['username'];
                    $email = $request['email'];

                    $crtChat = \App\Helpers\Collaboration::crtAccount($name, $username, $email, $pass);

                    if ($crtChat['success']) {
                        $update['chat_acc'] = 'created';
                        $user->update($update);

                        $scc = true;
                        $msg = "Your collaboration account is created!";
                    } else {
                        $scc = false;
                        $msg = "Error creating your collaboration account, please try again later.";
                    }
                } else {
                    $scc = false;
                    $msg = "Password is not Correct!";
                }
            } catch (\Exception $e) {
                $scc = false;
                $msg = "Error creating your collaboration account, please try again later.";
            }
        }

        return response()->json(['success' => $scc, 'msg' => $msg, ]);
    }
}
