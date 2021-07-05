<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(){
        return view('admin.auth.register');
    }
    public function submitRegister(Request $request){
        //dd($request);//do or die
        $validated = $request->validate([
            'name'=>'required|min:3|max:50',
            'email'=>'required|email|unique:users', //same email cannot be used by different persons.
            'password'=>'required|min:6|max:100',
            'confirm-password'=>'required|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->save();
        return redirect()->back()->with(['success'=>'Registered Sucessfully.']);
    }
    public function viewLogin(){
        //dd(Auth::user());
        if(Auth::check()){
            return redirect()->route('admin.includes.dashboard');
        }else{
            return view('admin.auth.login');
        }
    }
    public function submitLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:100',
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('admin.includes.dashboard');
        }else{
            return redirect()->back()->with(['error'=>'Email or Password do not match.']);
        }

    }
}
