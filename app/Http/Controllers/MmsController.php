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
use Image;

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
     * Menampilkan Halaman Registrasi user setelah pembayaran
     *
     * @return \Illuminate\Http\Response
     */
    public function register($code)
    {               
        $results = Form_result::where('trackingcode', '=', $code)->get();
        if (count($results)<=0) {
          return redirect('/');
        } if ($results[0]->id_user) {
          return redirect('/');
        }

        $name = "";
        $email = "";
        $compclass = "";
        $compname = "";
        $territory = "";
        foreach ($results as $key => $result) {
            $question = $result->question;
            if (str_contains($question, "Nama Penanggung Jawab")) {
                $name = $result->answer;                
            } else if (str_contains($question, "Email Penanggung Jawab")) {
                $email = $result->answer;
            } else if (str_contains($question, "Bentuk Perusahaan")) {
                $compclass = $result->answer;
            } else if (str_contains($question, "Nama Perusahaan")) {
                $compname = $result->answer;
            } else if (str_contains($question, "Kabupaten / Kota")) {
                $territory = $result->answer_value;
            }
        }

        return view('mms.register', compact('code', 'name', 'email', 'compclass', 'compname', 'territory'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createuser(FormResultRequest $request)
    {        
         $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',            
        ]);
        $input = $request->all();        
        // return $input;

        $code = $input['trackingcode'];
        $name = $input['name'];
        $username = $input['username'];
        $email = $input['email'];
        $password1 = $input['password'];
        $password2 = $input['password_confirmation'];
        $territory = $input['territory'];

        $user = new User;

        $user->name = $name;
        $user->username = $username;
        $user->email = $email;
        $user->password = Hash::make($password1);
        $user->role = "2";
        $user->no_kta = "0";
        $user->no_rn = "0";
        $user->territory = $territory;

        $user->save();   

        $admins = User::where('role', '=', '1')->get();
        $data = array();
        foreach ($admins as $key => $admin) {
            $notif = new Notification;

            $notif->target = $admin->id;
            $notif->senderid = $user->id;
            $notif->value = "New User Registered";
            $notif->active = true;
                    
            $notif->save();
        }

        $results = Form_result::where('trackingcode', '=', $code)->get();

        foreach ($results as $key => $result) {
            $result->id_user = $user->id;
            $result->save();
        }            

        $file = storage_path() . '/app/photoprofile/default-profile.png';
        $img = Image::make($file);
        $img->save(storage_path() . '/app/photoprofile'.'/'.$user->username.'.jpg');

        return redirect('/login');
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

    public function images($filename)
    {
        $file = storage_path() . '/app/photoprofile'.'/'.$filename;

        if(!\File::exists($file)) {            
            $file = storage_path() . '/app/photoprofile/default-profile.png';
        }
        
        $img = Image::make($file);

        return $img->response('jpg');
    }    
}
