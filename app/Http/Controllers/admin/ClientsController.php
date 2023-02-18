<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDoc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->guard('admin')->user()->can('read-clients')) {
            return abort(404);
        }
        $query = User::query();
        $data = $query->get();
        return view('admin.clients.index', compact('data'));
    }

    public function show($property)
    {
        if(!auth()->guard('admin')->user()->can('read-clients')) {
            return abort(404);
        }
        $property = User::with('docs')->findOrFail($property);
        return view('admin.clients.show')->with('item', $property);
    }

    public function create()
    {
        if(!auth()->guard('admin')->user()->can('write-clients')) {
            return abort(404);
        }
        $property = new User();
        return view('admin.clients.add-edit')->with('item', $property);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'company_name' => 'required',
            'contact_name' => 'required',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
            'whatsapp_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
            'address' => 'required',
            'license_number' => 'required',
        ]);
        try {
            $item = new User();
            $item->name =  $request->name;
            $item->email =  $request->email;
            $item->password = Hash::make($request->password);
            $item->temporary_password = Crypt::encrypt($request->password);
            $item->company_name =  $request->company_name;
            $item->contact_name =  $request->contact_name;
            $item->mobile_number =  $request->mobile_number;
            $item->whatsapp_number =  $request->whatsapp_number;
            $item->address =  $request->address;
            $item->license_number =  $request->license_number;
            $item->save();
            return  Redirect(route('clients.index'))->with('success', 'Client Created Successfully');
        } catch (Exception $e) {
            return  Redirect(route('clients.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        if(!auth()->guard('admin')->user()->can('write-clients')) {
            return abort(404);
        }
        $property = User::where('id', $id)->first();
        return view('admin.clients.add-edit')->with('item', $property);
    }

    public function update(Request $request, $id)
    {

        $item = User::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:6',
            'company_name' => 'required',
            'contact_name' => 'required',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
            'whatsapp_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
            'address' => 'required',
            'license_number' => 'required',
        ]);
        try {
            $item->name =  $request->name;
            $item->email =  $request->email;
            if ($request->password) {
                $item->password = Hash::make($request->password);
                $item->temporary_password = Crypt::encrypt($request->password);
            }
            $item->company_name =  $request->company_name;
            $item->contact_name =  $request->contact_name;
            $item->mobile_number =  $request->mobile_number;
            $item->whatsapp_number =  $request->whatsapp_number;
            $item->address =  $request->address;
            $item->license_number =  $request->license_number;
            $item->save();

            return  Redirect(route('clients.index'))->with('success', 'Client Updatd Successfully');
        } catch (Exception $e) {
            return  Redirect(route('clients.edit', ['client' => $id]))->with('error', 'Facing Error!');
        }
    }

    public function destroy($id)
    {
        if(!auth()->guard('admin')->user()->can('delete-clients')) {
            return abort(404);
        }
        try {
            User::where('id', $id)->delete();
            return Redirect(route('clients.index'))->with('success', 'Client Deleted Successfully');
        } catch (Exception $e) {
            return Redirect(route('clients.index'))->with('error', $e->getMessage());
        }
    }


    public function docCreate($client)
    {
        if(!auth()->guard('admin')->user()->can('read-clients')) {
            return abort(404);
        }
        $doc = new UserDoc();
        $client = User::where('id', $client)->select('id', 'name')->first();
        return view('admin.clients.add-doc')->with('item', $doc)->with('client', $client);
    }

    public function docStore(Request $request, $client)
    {

        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg,pdf,word'
        ]);
        try {
            $doc = new UserDoc();
            $doc->user_id = $client;
            $doc->title = $request->title;

            if ($request->file('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('clients/docs', $filename);
                $file = '/clients/docs/' . $filename;
                $doc->file = $file;
            }
            $doc->save();
            return  Redirect(route('clients.index'))->with('success', 'Client Document Uploaded Successfully');
        } catch (Exception $e) {
            return  Redirect(route('client.doc.create', ['client' => $client]))->with('error', 'Facing Error!');
        }
    }

    public function docDestroy($client, $id)
    {
        if(!auth()->guard('admin')->user()->can('read-clients')) {
            return abort(404);
        }
        try {
            UserDoc::where('id', $id)->delete();
            return Redirect(route('clients.show', ['client' => $client]))->with('success', 'Client Document Deleted Successfully');
        } catch (Exception $e) {
            return Redirect(route('clients.show', ['client' => $client]))->with('error', $e->getMessage());
        }
    }
}
