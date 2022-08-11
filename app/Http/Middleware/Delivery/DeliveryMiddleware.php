<?php

namespace App\Http\Middleware\Delivery;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
         if( Auth::check() ){
            if( Auth::user()->role_id <= 5 ){
                return $next($request);
            }else{
                $notification = [
                    'message' => 'You are not Allowed to Access!!...',
                    'alert-type' => 'warning'
                ];
                return redirect()->route('admin.dashboard')->with($notification);
            }
        }else{
            return redirect()->route('login');
        }
    }
}
