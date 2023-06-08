<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class TrusteeController extends Controller
{
    /**
     * Show the trustee login form.
     *
     * @return \Illuminate\View\View
     */
    /*public function showLoginForm()
    {
        return view('auth.login', ['type' => 'trustee']);
    }

    /**
     * Handle a login request to the application for a trustee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /*public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('trustee')->attempt($credentials)) {
            return redirect()->route('trustee.dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
    public function showRegistrationForm()
    {
        return view('auth.register', ['type' => 'trustee']);
    }*/

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function TrusteeIndex(){
        return view('trustee.trustee_login');
    }

    public function TrusteeDashboard(){
        return view('trustee.index');
    }

    public function TrusteeLogin(Request $request){
        //dd($request->all());

        $check = $request->all();

        if(Auth::guard('trustee')->attempt(['email'=>$check['email'],'password'=>$check['password']])){
            return redirect()->route('trustee.dashboard')->with('error','Trustee Login Successfully');
        }else{
            return back()->with('error', 'Invalid Email or Password');
        }
    }

    public function TrusteeLogout(){

        Auth::guard('trustee')->logout();
        return redirect()->route('trustee_login_from')->with('error','Trustee Logout Successfully');
    }


    /*public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:trustees|max:255',
            'password' => 'required|string|confirmed|min:8|max:255',
        ]);
        $trustee = Trustee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($trustee));

        Auth::guard('trustee')->login($trustee);

        return redirect()->route('trustee.dashboard');
    }*/
}

