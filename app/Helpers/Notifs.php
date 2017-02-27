<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Notification;

class Notifs
{    
    /**
     * Get the Notifications
     */
    public static function getNotifs()
    {
        $notifs = Notification::where([
                        ['target', '=', Auth::user()->id],
                        ['active', '=', true],
                    ])->orderBy('created_at', 'desc')->get();
        return $notifs;
    }

    public static function create($targer, $sender, $senderc, $msg)
    {
        $notif = new Notification;
        $notif->target = $targer;
        $notif->senderid = $sender;
        $notif->sendercode = $senderc;
        $notif->value = $msg;
        $notif->active = true;
        $notif->save();
    }
}
