<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(auth()->attempt(['email' => $input["email"], 'password' => $input['password']])){
            if(auth()->user()->role == 'super_admin'){
                return redirect()->route('myra.index');
            }
            if(auth()->user()->role == 'admin'){
                return redirect()->route('myra.index');
            }
            if(auth()->user()->role == 'faculty'){
                return redirect()->route('myra.index');
            }
        }
        else{
            session()->flash('error', "Incorrect email or password");
            return redirect()->route('login')->with("error", 'Incorrect email or password');   
        }
        
    }

    public function logout(Request $request){
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
