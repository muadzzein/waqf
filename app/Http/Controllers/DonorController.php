<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /*public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('donor')->attempt($credentials)) {
            return redirect()->route('donor.dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }*/

    public function Index(){
        return view('donor.donor_login');
    }

    public function Dashboard(){
        return view('donor.index');
    }

    public function Login(Request $request){
        //dd($request->all());

        $check = $request->all();

        if(Auth::guard('donor')->attempt(['email'=>$check['email'],'password'=>$check['password']])){
            return redirect()->route('donor.dashboard')->with('error','Donor Login Successfully');
        }else{
            return back()->with('error', 'Invalid Email or Password');
        }
    }

}

