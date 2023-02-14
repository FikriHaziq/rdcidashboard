<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\LoginApi;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    use LoginApi;

    public function index() {
        return view('login');
    }

    public function requestAccess($staff_id = null) {
        if(!$staff_id){
            return redirect()->route('login');
        }
        else {
            $staff = User::whereStaffId($staff_id)->where('status', '!=', 'rejected')->first();
            if(!$staff)$staff = session()->get('staff_temp');
            if($staff)return view('request-access', compact('staff'));
            else return redirect()->route('login');
        }
    }

    public function requestAccessPost(Request $request) {
        $this->validate($request, [
            'faculty_code'=>'required',
        ],
        [
            'faculty_code.required'=>'Faculty is required'
        ]);
        $staff = session()->get('staff_temp');
        $user = User::whereEmail($staff->email)->whereStatus('rejected')->first();
        if(!$user){
            $user = new User;
            $user->password = bcrypt('fakulti1234');
            $user->email = $staff->email;
        }
        $user->staff_id = $staff->employeeNumber;
        $user->name = $staff->fullname;
        $user->ic_no = $staff->nokp;
        $user->role_radis = json_encode($staff->roles ?? []);
        $user->role = 'unassigned';
        $user->faculty_code = $request->faculty_code;
        $user->status = 'pending';
        $user->save();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('request-access', $user->staff_id);
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);
        //dev purpose : start
        if(in_array($input['email'], ['superadmin@rdci.com', 'admin@rdci.com', 'fkt@rdci.com'])){
            if(auth()->attempt(['email' => $input["email"], 'password' => $input['password']])){
                saveUser([
                    'id' => auth()->user()->id,
                    'staff_id' => null,
                    'email' => auth()->user()->email,
                    'name' => auth()->user()->name,
                    'nric' => null,
                    'role' =>  auth()->user()->role,
                    'faculty' =>  getFacultyByCode(auth()->user()->faculty_code)->description_1 ?? null,
                    'faculty_code' => auth()->user()->faculty_code,
                    'school' =>  getSchoolByCode(auth()->user()->school_code)->description_1 ?? null,
                    'school_code' => auth()->user()->school_code,
                ]);
                // dd(user());
                if(user()->role == 'super_admin'){
                    return redirect()->route('myra.index');
                }
                if(user()->role == 'admin'){
                    return redirect()->route('myra.index');
                }
                if(user()->role == 'faculty'){
                    return redirect()->route('myra.index');
                }
            }
            else{
                session()->flash('error', "Incorrect email or password");
                return redirect()->route('login')->with("error", 'Incorrect email or password');   
            } 
        }
        //dev purpose : end

        $auth = $this->authenticate($request->email, $request->password);
        // dd($auth);
        if($auth->status() == 200){
            $token = $auth->json()['token'];
            $verify = $this->verifyAccountAccess($token);
            if($verify->status){
                // dd($verify);
                return redirect()->route('myra.index');
            }
            else{
                session()->put('staff_temp', $verify->data); 
                return redirect()->route('request-access', $verify->data->employeeNumber ?? null);
            }
        }
        else {
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
