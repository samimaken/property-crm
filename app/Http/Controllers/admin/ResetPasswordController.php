<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use App\Admin; 
use Hash; 

class ResetPasswordController extends Controller
{
      public function getPassword($token) { 

     return view('admin.auth.update', ['token' => $token]);
	  }

	  public function updatePassword(Request $request)
	  {

	  $request->validate([
	      'email' => 'required|email|exists:admins',
	      'password' => 'required|string|min:6|confirmed',
	      'password_confirmation' => 'required',

	  ]);

	  $updatePassword = DB::table('password_resets')
	                      ->where(['email' => $request->email, 'token' => $request->token])
	                      ->first();

	  if(!$updatePassword)
	      return back()->withInput()->with('error', 'Invalid token!');

	    $user = Admin::where('email', $request->email)
	                ->update(['password' => Hash::make($request->password)]);

	    DB::table('password_resets')->where(['email'=> $request->email])->delete();

	    return redirect('admin/login')->with('message', 'Your password has been changed!');

	  }
}
