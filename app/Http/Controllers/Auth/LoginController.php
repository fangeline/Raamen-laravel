<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    use AuthenticatesUsers;
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

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
        ]);
        if(auth()->attempt(['username'=>$input['username'], 'password'=>$input['password']]))
        {
            if(auth()->user()->role == 'staff')
            {
                return redirect() -> route('home.staff');
            }
            else if(auth()->user()->role == 'member')
            {
                return redirect() -> route('home.member');
            }
            else if(auth()->user()->role == 'admin')
            {
                return redirect() -> route('home.admin');
            }
        }
        else
        {
            return redirect()->route('newlogin')->with("error", 'Incorrect email or password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
