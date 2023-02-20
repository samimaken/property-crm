<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCredentials;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;

class UsersManagmentController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->guard('admin')->user()->can('read-users')) {
            return abort(404);
        }
        $query = Admin::whereHas('roles',function($q){
            return $q->where('name', '!=', 'admin');
        });
        $data = $query->get();
        return view('admin.users.index', compact('data'));
    }

    public function show($user)
    {
        if(!auth()->guard('admin')->user()->can('read-users')) {
            return abort(404);
        }
        $user = Admin::with('permissions')->findOrFail($user);
        return view('admin.users.show')->with('item', $user);
    }

    public function create()
    {
        if(!auth()->guard('admin')->user()->can('write-users')) {
            return abort(404);
        }
        $user = new Admin();
        $permissions = Permission::all();
        $allPermissions = [
            'delete' =>  false,
            'write' =>  false,
            'read' =>  false,
        ];
        return view('admin.users.add-edit')->with('item', $user)->with('permissions', $permissions)->with('allPermissions', $allPermissions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:admins,user_name',
            'email' => 'required|unique:admins,email',
            'password' => 'required|confirmed|min:6',
            'position' => 'required',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
        ]);
        try {
            $item = new Admin();
            $item->name =  $request->name;
            $item->email =  $request->email;
            $item->password = Hash::make($request->password);
            $item->temporary_password = Crypt::encrypt($request->password);
            $item->user_name =  $request->user_name;
            $item->position =  $request->position;
            $item->mobile_number =  $request->mobile_number;
            $item->save();
            $item->syncRoles('user');
            if($request->permissions) {
                $item->syncPermissions($request->permissions);
            }

            $data = [];
            $data['email'] = $request->email;
            $data['password'] = $request->password;
            $data['name'] = $request->name;
            Mail::to($request->email)->send(new UserCredentials($data));
            return  Redirect(route('users.index'))->with('success', 'User Created Successfully');
        } catch (Exception $e) {
            return  Redirect(route('users.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        if(!auth()->guard('admin')->user()->can('write-users')) {
            return abort(404);
        }
        $user = Admin::where('id', $id)->first();
        $user['permission_ids'] = $user->permissions()->pluck('id')->toArray();
        $user_deleted = $user->permissions()->where('group', 'delete')->count();
        $user_read = $user->permissions()->where('group', 'read')->count();
        $user_write = $user->permissions()->where('group', 'write')->count();
        $permissions = Permission::all();
        $delete_count = Permission::where('group', 'delete')->count();
        $write_count = Permission::where('group', 'write')->count();
        $read_count = Permission::where('group', 'read')->count();
        $allPermissions = [
            'delete' => $user_deleted == $delete_count ? true : false,
            'write' => $user_write == $write_count ? true : false,
            'read' => $user_read == $read_count ? true : false,
        ];
        return view('admin.users.add-edit')->with('item', $user)->with('permissions', $permissions)->with('allPermissions', $allPermissions);
    }

    public function update(Request $request, $id)
    {

        $item = Admin::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:admins,user_name,'.$id,
            'email' => 'required|unique:admins,email,'.$id,
            'password' => 'nullable|confirmed|min:6',
            'position' => 'required',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
        ]);
        try {
            $item->name =  $request->name;
            $item->email =  $request->email;
            if ($request->password) {
                $item->password = Hash::make($request->password);
                $item->temporary_password = Crypt::encrypt($request->password);
            }
            $item->user_name =  $request->user_name;
            $item->position =  $request->position;
            $item->mobile_number =  $request->mobile_number;
            $item->save();
            if($request->permissions) {
                $item->syncPermissions($request->permissions);
            } else {
                $item->revokePermissionTo($item->permissions()->pluck('name')->toArray());
            }

            return  Redirect(route('users.index'))->with('success', 'User Updatd Successfully');
        } catch (Exception $e) {
            return  Redirect(route('users.edit', ['user' => $id]))->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        if(!auth()->guard('admin')->user()->can('delete-users')) {
            return abort(404);
        }
        try {
            Admin::where('id', $id)->delete();
            return Redirect(route('users.index'))->with('success', 'User Deleted Successfully');
        } catch (Exception $e) {
            return Redirect(route('users.index'))->with('error', $e->getMessage());
        }
    }
}
