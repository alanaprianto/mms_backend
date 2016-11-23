<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Notification;

class AuthRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {                    
            return redirect('/');
        } else {                            
            if (Auth::user()->role!=1) {
                return redirect('/');
            }
        }

        $notifs = Notification::where([
                        ['target', '=', Auth::user()->id],
                        ['active', '=', true],
                    ])->orderBy('created_at', 'desc')->get();      

        $request->attributes->add(['notifs' => $notifs]);
        return $next($request);
    } 
}
