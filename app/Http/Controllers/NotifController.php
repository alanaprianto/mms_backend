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
        $notif = Notification::findOrFail($id);

        $notif->active=false;
        $notif->save();

        $notifs = \Request::get('notifs');
        
        if ($notif->senderid) {
        	$user = User::findOrFail($notif->senderid);
        	$id = $user->id;	
        	return view('form.notif.indexuser', compact('notifs', 'id'));
        }

        $code = $notif->sendercode;                
        return view('form.notif.indexresult', compact('notifs', 'code'));                
    }

    public function notifresultAjax($code) {
        $fr = Form_result::
                leftJoin('form_question', 'form_result.id_question', '=', 'form_question.id')          
                ->leftJoin('users', 'form_result.id_user', '=', 'users.id')
                ->where('form_result.trackingcode', '=', $code)
                ->select(['form_result.id', 'form_question.question', 'form_result.answer_value', 'users.name', 'form_result.trackingcode', 'form_result.id_question']);        
        return Datatables::of($fr)->make(true);        
    }

    public function notifuserAjax($id) {        
        $fr = User::
        		where('id', '=', $id)
        		->select(['id', 'name', 'username', 'email']);
        return Datatables::of($fr)->make(true);
    }

    public function notifall()
    {                           
        $notifs = \Request::get('notifs');        

       	return view('form.notif.indexall', compact('notifs'));
    }
}
