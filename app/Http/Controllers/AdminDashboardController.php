<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
    	$data = array('page_title' => 'Dashboard' );
    	return view('super_admin/dashboard/dashboard',$data);
    }    
}
