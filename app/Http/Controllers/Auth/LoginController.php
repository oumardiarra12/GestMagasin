<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:admin')->except('logout');
    // }
    public function index()
    {
        return view('auth.login');
    }
    public function Login(LoginUserRequest $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //return redirect()->intended('/');
            if (auth()->user()->categorie->id==1) {
                return redirect()->intended('/');
            }else if (auth()->user()->categorie->id ==2) {
                return redirect()->intended('/gerant');
            }else if (auth()->user()->categorie->id == 3){
                return redirect()->intended('/user');
            }
        }else {
            return redirect()->route('login');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerate(true);

        return redirect()->route('login');
    }
}
