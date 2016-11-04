<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Notification;
use App\Form_result;
use Datatables;

class NotifController extends Controller
{
    /**
     * Menangani permintaan detail notif
     *
     * @return \Illuminate\Http\Response
     */
    public function notif($id)
    {                           
        $notif = Notification::find($id);

        $notif->active=false;
        $notif->save();

        $notifs = \App\Helpers\Notifs::getNotifs();
        
        if ($notif->senderid) {
        	$user = User::find($notif->senderid);            
            $id = "0";
            if ($user) {
        	   $id = $user->id;	            
            }
        	return view('form.notif.indexuser', compact('notifs', 'id'));
        }

        $code = $notif->sendercode;                
        return view('form.notif.indexresult', compact('notifs', 'code'));                
    }

    public function notifresultAjax($code) {        
        $fr = Form_result::where('trackingcode', '=', $code)->get();
                // leftJoin('form_question', 'form_result.id_question', '=', 'form_question.id')          
                // leftJoin('users', 'form_result.id_user', '=', 'users.id')
                // ->select(['form_question.question', 'form_result.answer_value', 'form_result.trackingcode', 'form_result.id_question',
                //         'form_result.created_at']);        
        return Datatables::of($fr)->make(true);        
    }

    public function notifuserAjax($id) {        
        $fr = User::
        		where('id', '=', $id)->get();
        		// ->select(['id', 'name', 'username', 'email']);
        return Datatables::of($fr)->make(true);
    }

    public function notifall()
    {                           
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
       	return view('form.notif.indexall', compact('notifs'));
    }
}