<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    { 
        $this->middleware('guest:admin', ['except' => ['logout']]);  
    }


    

    public function username(){
        return 'email';
    } 

    public function login(Request $request){   
      //  if(Auth::user()) return redirect()->intended(route('admin.dashboard'));
       
        if ($request->isMethod('post')) {
      
            $this->validate($request, [
                $this->username() => 'required', 'password' => 'required',
            ]);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'type'=>'superadmin'])) {
                return redirect()->intended(route('admin.dashboard'));
            }else{
                return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => 'Wrong Email address or password.',
                ]);
            }
     }
        return view('admin.login');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->intended(route('admin.login'));
    } 


    protected function guard()
    {
        return Auth::guard('admin');
    }
}
