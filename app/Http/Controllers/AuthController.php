<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function signOut() 
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(['type'=> 'success','msg'=> 'You Have Logged In Successfully']);
        }
        return response()->json(['type'=> 'error','msg'=> 'Login Attempt Failed']);
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data['password'] = Hash::make($data['password']);
        $check = User::create($data);
        if($check){
            return response()->json(['type'=> 'success','msg'=> 'Account Created Successfuly']);
        }
        return response()->json(['type'=> 'error','msg'=> 'Register Attempt Failed']);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
        ]);

        if($request->new_password == $request->confirm_password){
            $user = User::query()->where('email',Auth::user()->email)->first();
            $user->password = Hash::make($request->new_password);
            $update = $user->update();
            if($update){
                return response()->json(["success" => true,"msg" => "Password Updated Successfully."]);
            }else{
                return response()->json(["success" => false,"msg" => "Failed"]);
            }
        }else{
            return response()->json(["success" => false,"msg" => "Confirm password does not match"]);
        }
    }
}
