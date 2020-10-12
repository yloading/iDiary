<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        // if(!Auth::check() && $request->path() == 'login') {
        //     return view('welcome');
        // }

        // if((Auth::check() && $request->path() == 'login') || (Auth::check() && $request->path() == 'sign-up')) {
        //     return redirect('/');
        // }


        return view('welcome');
    }

    public function logout()
    {
        if(Auth::check()) {
            Auth::logout();
            return redirect('/login');
        }
        else {
            return redirect('/login');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|bail|unique:users',
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'bail|required|min:8'
        ]);

        $password = bcrypt($request->password);
        $user = User::create([
            'email' => $request->email,
            'full_name' => $request->name,
            'username' => $request->username,
            'password' => $password            
        ]);

        return $user;
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'bail|required|min:8'
        ]);  

        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ]))
        {
            return response()->json([
                'msg' => 'You are logged in'
            ]);
        }
        else {
            return response()->json([
                'msg' => 'You have entered an invalid username or password.'
            ], 401);            
        }
    }
}
