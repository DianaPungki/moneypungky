<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('admin.login-form');
    }

    //todo: admin login functionality
    public function login_functionality(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email_admin' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/admin');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }
    }

    //todo: admin logout functionality
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
