<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientMenu;
use App\ClientMenuAccess;
use Session,Hash;
use Exception;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
	public function index()
    {

        $clients = Client::orderBy('updated_at','desc')->get();
        $menus = ClientMenu::all()->where('MenuParentId',null);
    	$data = array('page_title' => 'Client','all_client' =>$clients,'client_menus' =>$menus);
    	return view('super_admin/client/index',$data);
    }
    public function client_access()
    {
    	$data = array('page_title' => 'Client Access' );
    	return view('super_admin/client/client_access',$data);	
    }
    public function datatable()
    {
        # code...
    }
    public function get(request $request)
    {

        $client = Client::find($request->id);
        $menus = ClientMenuAccess::where(['ClientId'=>$client->id, 'IsActive'=>'1'])->pluck('MenuId');
        $client->selected_menu = $menus;
        return $client;
    }
    public function add(Request $request)
    {

        $request->validate([
            'FirstName'=>'required',
            'LastName'=>'required',
            'Email'=>'required|unique:clients',
            'MobileNumber'=>'required|numeric',
            'Password'=>'required',
            'IsActive'=>'required'
        ]);
        try{
            $client = new Client;
            $client->FirstName=$request->FirstName;
            $client->LastName=$request->LastName;
            $client->Email=$request->Email;
            $client->MobileNumber=$request->MobileNumber;
            $client->IsActive=$request->IsActive;
            $client->Password=Hash::make($request->Password);
            $client->CreatedBy=Auth::guard('admin')->user()->id;
            $client->UpdatedBy=Auth::guard('admin')->user()->id;
            if ($client->save()) {
                $menus = ClientMenu::select("id")->where('MenuParentId',null)->get();
                foreach($menus as $value){
                    $test[] = [
                            "ClientId" => $client->id,
                            "MenuId" => $value->id,
                            "IsActive" => "0",
                            "created_at" =>  \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                            "CreatedBy" =>Auth::guard('admin')->user()->id,
                            "UpdatedBy" =>Auth::guard('admin')->user()->id,
                    ];
                }
                ClientMenuAccess::insert($test);
                ClientMenuAccess::where('ClientId',$client->id)
                                    ->whereIn('MenuId',$request->ClientMenu)
                                    ->update(['IsActive' =>"1"]);
                return ['id' => $client->id];
            }else{
                Session::flash("message","Client Can Not Be Inserted");
            }
        }catch(Exception $e){
            return \Response::json(['message' => 'Something went wrong ','errors' => ["Please try again or contact Administor"]], 404);
        }
    }

    public function delete(request $request)
    {
        $client = Client::find($request->id);
        if (isset($client)) {
            if ($client->delete()) {
                Session::flash("message","Client Deleted Sucessfully");
            }else{
                Session::flash("message","Client Can Not Be Deleted");
            }
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'FirstName'=>'required',
            'LastName'=>'required',
            'Email'=>'required|unique:clients,id,'.$request->id,
            'MobileNumber'=>'required|numeric',
            'IsActive'=>'required'
        ]);

            $client = Client::find($request->id);
            $client->FirstName=$request->FirstName;
            $client->LastName=$request->LastName;
            $client->Email=$request->Email;
            $client->MobileNumber=$request->MobileNumber;
            $client->IsActive=$request->IsActive;
            $client->UpdatedBy=Auth::guard('admin')->user()->id;

            ClientMenuAccess::where('ClientId',$client->id)
                                    ->update(['IsActive' =>"0"]);

            ClientMenuAccess::where('ClientId',$client->id)
                                    ->whereIn('MenuId',$request->update_ClientMenu)
                                    ->update(['IsActive' =>"1"]);

            if ($client->save()) {
                return ['id' => $client->id];
            }else{
                // Session::flash("message","Client Can Not Be Inserted");
            }
        try{
        }catch(Exception $e){
            return \Response::json(['message' => 'Something went wrong ','errors' => ["Please try again or contact Administor"]], 404);
        }
    }
    public function authenticat_user(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('client')->attempt(array('Email' => $request->username, 'password' => $request->password)))
        {
            return redirect('dashboard');
        }else{
            Session::flash("message","Invalid userid or password");
            return redirect('/');
        }
    }
}
