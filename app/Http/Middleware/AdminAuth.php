<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use App\SuperAdminMenu;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::guard('admin')->check()) {
            return redirect('/admin');
        }

        $data = SuperAdminMenu::where('MenuParentId',null)->with("subMenu")->get();
        \View::share('menu', $data);
        return $next($request);
    }
}
