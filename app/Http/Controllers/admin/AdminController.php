<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function index($lang='')
    {
    	if(!empty($lang))
    	{
    		Session::put('rtl','rtl');
    	}
    	else
    	{
    		Session::forget('rtl');
    	}

    	return view('admin.index');
    }
}
