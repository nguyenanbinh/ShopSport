<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
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

    public function showLoginHomePage()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }
        return redirect()->back();
    }

    public function loginHomePage(Request $request)
    {
        $data = $request->only('email','password');
            // dd($data);
        // $users = User::all();
        // dd($users->toArray());
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->back();
        }
        return redirect()->back()->withInput()->with(['error' => 'Email or password wrong']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
