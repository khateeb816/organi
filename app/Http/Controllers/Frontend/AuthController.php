<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function UserRegisterSave(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $data = $request->all();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        // $data['password_confirmation'] = bcrypt($request->password_confirmation);
        $data['role'] = 'customer';
        $status = \App\Models\User::create($data);
        if($status){
            return redirect()->route('UserLoginForm')->with('success', 'Successfully registered');
        }else{
            return back()->with('error', 'Something went wrong');
        }


    }
    public function UserLoginForm(){
        return view('frontend.auth.login');
    }

    public function UserLoginCheck(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {

            if(Auth::user()->role == 'customer'){

                return redirect('/');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function Userlogout()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function UserRegisterFrom(){
        return view('frontend.auth.register');
    }
}
