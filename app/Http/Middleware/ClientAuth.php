<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use App\ClientMenu;
use Illuminate\Support\Facades\DB;


class ClientAuth
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
        if (!Auth::guard('client')->check()) {
            return redirect('/');
        }

        // $data = ClientMenu::where('MenuParentId',null)->with(["clientAccesses"=>function($q){
        //     $q->where("ClientId", Auth::guard("client")->user()->id)->where("IsActive", 1);
        // }])->with("subMenu")->get();

        // $data = DB::select("SELECT * FROM ")->lefftJoin("tbl_asd", "asd", "asd")->->get()
        $data = DB::table('client_menus')
                    ->join('client_menu_accesses', 'client_menu_accesses.MenuId', '=', 'client_menus.id')
                    ->where(['client_menu_accesses.ClientId' =>Auth::guard('client')->user()->id,'client_menu_accesses.IsActive' => '1'])
                    ->select('client_menus.*')
                    ->get();
                    foreach ($data as $key => $value) {
                        $tmp = DB::table('client_menus')->where(['MenuParentId' =>$value->id])->get();

                        $data[$key]->subMenu  = $tmp;
                    }

        \View::share('menu', $data);
        return $next($request);
    }
}
