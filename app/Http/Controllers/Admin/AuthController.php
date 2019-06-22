<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
    	//$this->middleware('guest')->except('logout');
    }

    public function username()
    {
    	return 'name';
    }

    protected function guard()
    {
    	return Auth::guard('admin');
    }

    public function showLoginForm()
    {
    	return view('admin.auth.login');
    }
}
