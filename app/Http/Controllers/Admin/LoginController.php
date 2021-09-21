<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('is.admin');
    }

    public function show()
    {
        if (Auth::check() && Auth::user()->hasRole(['admin','mod'])) { 

            return view('admin.main')->with('error','Login Fail');
        }    
        Auth::logout();
        return view('admin.login')->with('success','Login Successful');
        
    }

    public function login(Request $rq)
    {
        if (Auth::attempt(array('email' => $rq->email, 'password' => $rq->password))) {
            return redirect()->route('admin.main');
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.form-login');
    }
}
