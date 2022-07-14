<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
 
class AuthController extends Controller
{
 
    public function index()
    {
        return view('login');
    }  
 
    public function registration()
    {
        return view('registration');
    }
     
    public function postLogin(Request $request)
    {
        request()->validate([
        'empID' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('empID', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function dashboard()
    {
      if(Auth::check()){
        return view('dashboard');
      }
       return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }

     
   /* public function logout(){
        Auth::logout();
        return view('login');
    }*/
}   