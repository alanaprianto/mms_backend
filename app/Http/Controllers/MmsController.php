<?php

namespace App\Http\Controllers;

use FontLib\Table\Type\name;
use Mockery\Matcher\Not;
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
use App\Payment;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Kbli;
use App\Regnum;
use Illuminate\Support\Collection;

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

    public function info(){
      $act2 = "active";
      return view('mms.informasi-content', compact('act2'));
    }
    
    public function help(){
      $act3 = "active";
      return view('mms.bantuan-content', compact('act3'));
    }

    public function pay1()
    {                
        
        return view('mms.pay1');
    }

    public function pay1store(Request $request)
    {                
        $input = Request::all();

        $trcode = $input['trackingcode'];
        $alb = substr($trcode, -3);
        $nn = "Nama Penanggung Jawab";
        $role = "2";
        if ($alb=="ALB") {
          $nn = "Nama Asosiasi/Himpunan";
          $role = "6";
        }

        $results = Form_result::where('trackingcode', '=', $trcode)->get();
        if (count($results)<=0) {
          return redirect('/');
        } if ($results[0]->id_user) {
          return redirect('/');
        }

        $name = "";
        $email = "";        
        $territory = "";
        $user = new User;
        $payment = new Payment;
        try {
          foreach ($results as $key => $result) {
              $question = $result->question;
              if (str_contains($question, $nn)) {
                  $name = $result->answer;                
              } else if (str_contains($question, "Email")) {
                  $email = $result->answer;
              } else if (str_contains($question, "Kabupaten / Kota")) {
                  $territory = $result->answer_value;
              }
          }

          $random_string = md5(microtime());
          $first = substr($random_string, 0, 4);
          $last = substr($random_string, -4);
          $username = $first.$last;
          $password = substr($random_string, 5, 14);

          $user->name = $name;
          $user->username = $username; //ini
          $user->email = $email;
          $user->password = Hash::make($password);
          $user->role = $role;
          // $user->no_kta = "0";
          // $user->no_rn = "0";
//          $crtChat = \App\Helpers\Collaboration::crtAccount($name, $username, $email, $password);
//          if ($crtChat) {
//            $user->chat_acc = "created";
//          } else {
//            $user->chat_acc = "failed";
//          }
          $user->chat_acc = "failed";
          $user->territory = $territory;
          $user->save();          

          $userid = $user->id;
          $attempt = Payment::where('id_user', $userid)->count()+1;
          $payment->id_user = $userid;
          $payment->attempt = $attempt;
          $payment->amount = 250000;
          $payment->payment_date = new Carbon();
          $payment->save();

          Mail::send('emails.register_succesfull', ['name' => $name, 'username' => $username, 'password' => $password], function($message) use ($email) {
              $message->from('no-reply@kadin-indonesia.org', 'no-reply');
              $message->to($email)->subject('Kadin Registration');                    
          });

          $pathold = storage_path() . '/app/uploadedfiles1/'.$trcode.'/';
          $pathnew = storage_path() . '/app/uploadedfiles/'.$username.'/';
          \File::copyDirectory($pathold, $pathnew);

          $name = "";
          $ext = "";
          $file = storage_path() . '/app/uploadedfiles1/'.$trcode;
          $filesInFolder = \File::files($file);
                
          foreach($filesInFolder as $path)
          {
            $files = pathinfo($path);
            if ($files['filename'] == $username) {
              $name = $files['filename'];
              $ext = $files['extension'];

              $imgold = storage_path() . '/app/uploadedfiles1/'.$trcode.'/'.$name.'.'.$ext;
              $imgnew = storage_path() . '/app/uploadedfiles/'.$username.'/'.$name.'.'.$ext;
              \File::move($imgold, $imgnew);
            }
          }

          \File::deleteDirectory($pathold);

          $admins = User::where('role', '=', '1')->get();
          foreach ($admins as $key => $admin) {
              $notif = new Notification;

              $notif->target = $admin->id;
              $notif->senderid = $user->id;
              $notif->value = "New User Registered";
              $notif->active = true;
                      
              $notif->save();
          }

          $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();
          foreach ($kadinKota as $key => $kota) {
              $notif = new Notification;

              $notif->target = $kota->id;
              $notif->senderid = $user->id;
              $notif->value = "New User Registered";
              $notif->active = true;
                      
              $notif->save();
          }

          $results = Form_result::where('trackingcode', '=', $trcode)->get();
          foreach ($results as $key => $result) {
              $result->id_user = $user->id;
              $result->update();
          }            

          $notif = new Notification;
          $notif->target = $user->id;
          $notif->senderid = 0;
          $notif->value = "Welcome!, Your Account has been succesfully created.";
          $notif->active = true;
          $notif->save();

          return redirect('register1success');
        } catch(\Exception $e){
            $user->delete();
            $payment->delete();
            $results = Form_result::where('trackingcode', '=', $trcode)->get();
            foreach ($results as $key => $result) {
                $result->id_user = "0";
                $result->update();
            }
            return $e;
            return redirect('/');
        }        
    }

    public function dashboardAdmin()
    {                       
      $notifs = \App\Helpers\Notifs::getNotifs();      

      return view('admin.dashboard.index', compact('notifs'));
    }    

    public function ktatrack(Request $request) {
      $input = Request::all();
      $code = $input['code'];          
      return view('mms.ktatracking-content', compact('code'));
    }

    // ktatrackrequestkta

    public function ktatrackcode ($code) {      
      $fr = \App\Form_result::where('trackingcode', '=', $code)->first();
      if (!$fr) {
        $kta = null;
      } else {
        $fr = $fr->id_user;
        $user = \App\User::where('id', '=', $fr)->first();

        $kta = \App\Kta::where('owner', '=', $user->id)->first();
          if ($kta) {
              $today = new Carbon();
              $exp = Carbon::parse($user->kta->first()->expired_at);

              $exp_month = $exp->diffInMonths($today);

              $exp_show = false;
              if ($exp_month<=3||$today >= $exp) {
                  $exp_show = true;

                  $exp_at = $exp_month;
                  if ($exp_month==0) {
                      $exp_at = $exp->diffInDays($today);

                      $m = "Hari";                
                  } else {
                      $m = "Bulan";                
                  }                
                  if ($today >= $exp) {
                      $exp_text1 = "Masa Berlaku KTA anda telah habis. Segera perpanjang KTA anda untuk terus menikmati layanan anggota Kadin.";
                      $exp_text2 = "Masa berlaku KTA anda telah habis sejak ";
                      $exp_text3 = $exp_at." ".$m." Lalu";
                  } else if ($exp_month<=3) {
                      $exp_text1 = "Masa Berlaku KTA anda telah berada di masa tenggang.";
                      $exp_text2 = "Kartu Tanda Anggota Anda tidak akan berlaku dalam ";
                      $exp_text3 = $exp_at." ".$m;
                  }
              }
              
              $ext_show = true;
              if ($kta->perpanjangan=="requested") {
                  $ext_show = false;
              }
          }
      }
      
      return view('mms.ktatracking-frame', compact('kta', 'exp_show', 'exp_text1', 'exp_text2', 'exp_text3', 'ext_show'));
    }

    public function kblilist(Request $request) {
      $input = Request::all();
      $type = $input['type'];
      $parent = $input['parent'];

      $kbli = Kbli::where('type', '=', $type)->where('parent', '=', $parent)->get();
      return $kbli;
    }

    public function kblilist1() {
      $kbli = Kbli::where('type', '=', '1')->where('parent', '=', '0')->get();
      return $kbli;
    }    
}
