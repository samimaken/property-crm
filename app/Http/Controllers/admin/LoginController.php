<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {

      if(Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){
            $user=Admin::where('email',$request['email'])->first();
            Auth::guard('admin')->login($user);
              return redirect()->route('admin.dashboard');

        }
        else{
              return redirect()->back()->with('error','Email/Password does not match!');
        }
    }
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
      }
       public function change_password()
      {
          Session::put('page','password');
        return view('admin.change-password');
      }
}
