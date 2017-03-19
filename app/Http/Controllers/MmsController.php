<?php

namespace App\Http\Controllers;

use App\Form_question;
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
    public function info(){
        $act2 = "active";
        return view('frontpage.informasi-content', compact('act2'));
    }

    public function help(){
        $act3 = "active";
        return view('frontpage.bantuan-content', compact('act3'));
    }

    public function register_ab()
    {
        $fquestions = Form_question::whereHas('group', function ($q) {
            $q->where('name', 'like', '%Pendaftaran%');
        })->orderBy('order', 'asc')->get();

        return view('frontpage.pendaftaran-content', compact('fquestions'));
    }

    public function register_alb()
    {
        $fquestions = Form_question::whereHas('group', function ($q) {
            $q->where('name', 'like', '%Anggota Luar Biasa%');
        })->orderBy('order', 'asc')->get();

        return view('frontpage.pendaftaran2-content', compact('fquestions'));
    }

    public function notfound()
    {
		return view('frontend.page_404');
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
          $crtChat = \App\Helpers\Collaboration::crtAccount($name, $username, $email, $password);
          if ($crtChat['success']) {
            $user->chat_acc = "created";
          } else {
            $user->chat_acc = "failed";
          }
          $user->territory = $territory;
          $user->save();          

          $userid = $user->id;
          $attempt = Payment::where('id_user', $userid)->count()+1;
          $payment->id_user = $userid;
          $payment->attempt = $attempt;
          $payment->amount = 250000;
          $payment->payment_date = new Carbon();
          $payment->save();

          Mail::send('emails.register_succesfull1', ['name' => $name, 'username' => $username, 'password' => $password], function($message) use ($email) {
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
              \App\Helpers\Notifs::create($admin->id, $user->id, null, "New User Registered");
          }

          $kadinKota = User::where('role', '=', '5')->where('territory', '=', $territory)->get();
          foreach ($kadinKota as $key => $kota) {
              \App\Helpers\Notifs::create($kota->id, $user->id, null, "New User Registered");
          }

          $results = Form_result::where('trackingcode', '=', $trcode)->get();
          foreach ($results as $key => $result) {
              $result->id_user = $user->id;
              $result->update();
          }            

          \App\Helpers\Notifs::create($user->id, $user->id, null, "Welcome!, Your Account has been succesfully created.");

          return redirect('register/success');
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

    public function ktatrack(Request $request) {
      $input = Request::all();
      $code = $input['code'];

      return view('frontpage.ktatracking-content', compact('code'));
    }

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
      return view('frontpage.ktatracking-frame', compact('kta', 'exp_show', 'exp_text1', 'exp_text2', 'exp_text3', 'ext_show'));
    }

    public function rntrack(Request $request) {
        $input = Request::all();
        $norn = $input['rnnumber'];
        $code = null;

        return view('frontpage.ktatracking-content', compact('code', 'norn'));
    }

    public function rntrackcode($norn) {
        $regnum = Regnum::where('regnum', '=', $norn)->first();

        if (!$regnum) {
            $rn = '';
        } else {
            $rn = $regnum->regnum;
        }

        return view('frontpage.rntracking-frame', compact('rn', 'norn'));
    }

    public function success() {
        return view('frontpage.pendaftaran-success');
    }

    public function successframe() {
        return view('frontpage.pendaftaran-successframe');
    }
}
