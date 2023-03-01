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

        $user  = auth()->user();
        $new = $user->visited;
        $user->visited = 1;
        $user->save();

    	return view('admin.index')->with('new', $new);
    }

    public function markNotification(Request $request)
    {
    auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

    return response()->noContent();
    }
}
