<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Trustee;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function Index(){
        return view('admin.admin_login');
    }

    public function Dashboard(){
        $user = User::all();
        $trustee = Trustee::all();
        return view('admin.index', compact('user', 'trustee'));
    }

    public function Login(Request $request){
        //dd($request->all());

        $check = $request->all();

        if(Auth::guard('admin')->attempt(['email'=>$check['email'],'password'=>$check['password']])){
            return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully');
        }else{
            return back()->with('error', 'Invalid Email or Password');
        }
    }

    public function AdminLogout(){

        Auth::guard('admin')->logout();
        return redirect()->route('login_from')->with('error','Admin Logout Successfully');
    }
    function addDonor(Request $req){

        User::insert([
            'name'=> $req->name,
            'email'=> $req->email,
            'password'=> Hash::make($req->password),
            'created_at'=> Carbon::now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Donor created successfully');

    }

}
