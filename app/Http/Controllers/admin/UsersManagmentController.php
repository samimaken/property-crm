<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersManagmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::whereHas('roles',function($q){
            return $q->where('name', '!=', 'admin');
        });
        $data = $query->get();
        return view('admin.users.index', compact('data'));
    }

    public function show($user)
    {
        $user = Admin::with('permissions')->findOrFail($user);
        return view('admin.users.show')->with('item', $user);
    }

    public function create()
    {
        $user = new Admin();
        $permissions = Permission::all();
        return view('admin.users.add-edit')->with('item', $user)->with('permissions', $permissions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'position' => 'required',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
        ]);
        try {
            $item = new Admin();
            $item->name =  $request->name;
            $item->email =  $request->email;
            $item->password = Hash::make($request->password);
            $item->user_name =  $request->user_name;
            $item->position =  $request->position;
            $item->mobile_number =  $request->mobile_number;
            $item->save();
            $item->syncRoles('user');
            if($request->permissions) {
                $item->syncPermissions($request->permissions);
            }
            return  Redirect(route('users.index'))->with('success', 'User Created Successfully');
        } catch (Exception $e) {
            return  Redirect(route('users.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = Admin::where('id', $id)->first();
        $user['permission_ids'] = $user->permissions()->pluck('id')->toArray();
        $permissions = Permission::all();
        // dd($user->toArray());
        return view('admin.users.add-edit')->with('item', $user)->with('permissions', $permissions);
    }

    public function update(Request $request, $id)
    {

        $item = Admin::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:users,name,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'nullable|confirmed|min:6',
            'position' => 'required',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
        ]);
        try {
            $item->name =  $request->name;
            $item->email =  $request->email;
            if ($request->password) {
                $item->password = Hash::make($request->password);
            }
            $item->user_name =  $request->user_name;
            $item->position =  $request->position;
            $item->mobile_number =  $request->mobile_number;
            $item->save();
            if($request->permissions) {
                $item->syncPermissions($request->permissions);
            }

            return  Redirect(route('users.index'))->with('success', 'User Updatd Successfully');
        } catch (Exception $e) {
            return  Redirect(route('users.edit', ['client' => $id]))->with('error', 'Facing Error!');
        }
    }

    public function destroy($id)
    {
        try {
            Admin::where('id', $id)->delete();
            return Redirect(route('users.index'))->with('success', 'User Deleted Successfully');
        } catch (Exception $e) {
            return Redirect(route('users.index'))->with('error', $e->getMessage());
        }
    }
}
