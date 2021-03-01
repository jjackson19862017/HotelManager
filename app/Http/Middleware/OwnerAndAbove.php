<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerAndAbove
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If the User isnt a Super User then they will get redirected
        if(!$user->userHasRole("super"||"owner"||"admin")){
            $request->session()->flash('message', 'Restricted Area, sent back to the Dashboard!');
            $request->session()->flash('text-class', 'text-warning');
            return redirect()->route('admin.index');
        }
        return $next($request);
    }
}
