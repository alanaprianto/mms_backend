<?php

namespace App\Http\Controllers\Alb;

use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AlbNotifController extends Controller
{
    public function notif_all()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('common.notif.indexall', compact('notifs'));
    }

    public function notif_show($id)
    {
        $notif = Notification::find($id);
        $notif->active=false;
        $notif->save();

        if (str_contains($notif->value, 'Welcome')) {
            return redirect('/alb/dashboard');
        } else if (str_contains($notif->value, 'KTA')) {
            return redirect('/alb/kta');
        } else if (str_contains($notif->value, 'National Registration')) {
            return redirect('/alb/rn');
        }

        return redirect('/alb/dashboard');
    }
}
