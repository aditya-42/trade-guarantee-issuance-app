<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function register(){
        return view('account.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'userType' => 'required|in:user,admin',
            'username' =>'required|min:3',
            'email' =>'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required',

        ]);


        
        if ($validator->fails()){
            return redirect()->route('account.register')-> withInput()->withErrors($validator);
        }

        $user = new User();

        $user->role = $request->userType;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->route('account.login')->with('success','You have registered successfully');

    }

    public function login(){
        return view('account.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' =>'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.profile');
        }

        else{
            return redirect()->route('account.login')->with('error','Check email or password again!');
        }
    }

    public function profile(){
        return view('account.profile');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
}
