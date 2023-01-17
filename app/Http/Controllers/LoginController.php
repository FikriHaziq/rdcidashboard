<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\LoginApi;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use LoginApi;

    public function index() {
        return view('login');
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);
        // $auth = $this->authenticate($request->email, $request->password);
        // dd($auth);
        // if($auth->status() == 200){
        //     $token = $auth->json()['token'];
        //     $tokenParts = explode(".", $token);  
        //     $tokenHeader = base64_decode($tokenParts[0]);
        //     $tokenPayload = base64_decode($tokenParts[1]);
        //     $jwtHeader = json_decode($tokenHeader);
        //     $jwtPayload = json_decode($tokenPayload);
        //     // dd($tokenHeader, $tokenPayload, $jwtHeader, $jwtPayload);
        //     // dd($auth->json()['token']);
        // }
        // else {
        //     session()->flash('error', "Incorrect email or password");
        //     return redirect()->route('login')->with("error", 'Incorrect email or password');  
        // }
        
        // dd($auth->json(), $request->cookie('SSOJWT'));
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
        // dd(auth());
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
