<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\admin;
use Illuminate\Http\Request;


class RegisterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }


    public function showRegisterForm()
    {
        return view('Admin.auth.register');

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required','date','before:18 years ago'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
        admin::create($request->all());

        return redirect()->intended(route('admin.dashboard'));
    }


}
