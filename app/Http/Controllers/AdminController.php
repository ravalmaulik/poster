<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuperAdminUser;
use App\SuperAdminMenu;
use Illuminate\Support\Facades\Auth;
use Session,Hash;

class AdminController extends Controller
{
    public function authenticat_user(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(array('email' => $request->username, 'password' => $request->password)))
        {
            return redirect('admin/dashboard');
        }else{
            Session::flash("message","Invalid userid or password");
            return redirect('/admin');
        }
    }
    public function test(Request $request)
    {
    	// $menu = SuperAdminMenu::get();
     //    return $menu;
       

        // $user->name="Admin";
        // $user->email='admin@sapratigs.com';
        // $user->password=Hash::make('123');
        // $user->IsActive='1';
        // if ($user->save()) {
        // 	echo "Data Save Sucessfully";
        // }else{
        // 	echo "Error in Data Save";
        // }
    }
}
