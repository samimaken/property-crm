<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon; 
use Mail; 

class ForgotPasswordController extends Controller
{
     public function getEmail()
	  {

	     return view('admin.auth.forgot');
	  }

	 public function postEmail(Request $request)
	  {
	    $request->validate([
	        'email' => 'required|email|exists:admins',
	    ]);

	    $token = $this->str_random(20);

	      DB::table('password_resets')->insert(
	          ['email' => $request->email, 'token' => $token]
	      );

	      Mail::send('admin.auth.verify', ['token' => $token], function($message) use($request){
	          $message->to($request->email);
	          $message->subject('Reset Password Notification');
	      });

	      return back()->with('success', 'We have e-mailed your password reset link!');
	  }

	  public function str_random($length = 10) {
			    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
			}

}
