<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyUnit;
use Exception;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->guard('admin')->user()->can('read-properties')) {
            return abort(404);
        }
        $query = Property::query();
         if($request->type == 'archived') {
            $query->onlyTrashed();
         }
        $data = $query->get();
        $archived = Property::onlyTrashed()->count();
        return view('admin.properties.index', compact('data'))->with('archived', $archived);
    }

    public function show($property) {
        if(!auth()->guard('admin')->user()->can('read-properties')) {
            return abort(404);
        }
        $property = Property::findOrFail($property);
        $privateUnits = PropertyUnit::where('property_id', $property->id)->where('type', 'private-unit')->count();
        $coworkingUnits = PropertyUnit::where('property_id', $property->id)->where('type', 'coworking-space')->count();
        return view('admin.properties.show')->with('item', $property)->with('privateUnits', $privateUnits)->with('coworkingUnits', $coworkingUnits);
    }

    public function create()
    {
        if(!auth()->guard('admin')->user()->can('write-properties')) {
            return abort(404);
        }
        $property = new Property();
        return view('admin.properties.add-edit')->with('item', $property);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'pma_contract_start_date' => 'required',
            'pma_contract_end_date' => 'required',
            'aed_value' => 'required',
            'sqft_size' => 'required',
            'meeting_room' => 'required',
            'conference_room' => 'required',
            'fully_furnished' => 'required',
            'address' => 'required',
            'pma_agreement' => 'required|mimes:pdf',
            'lat' => 'required'
        ], [
            'lat.required' => "Please Chose Location."
        ]);
        try {
            $item = new Property();
            $item->name =  $request->name;
            $item->location =  $request->location;
            $item->pma_contract_start_date =  $request->pma_contract_start_date;
            $item->pma_contract_end_date =  $request->pma_contract_end_date;
            $item->aed_value =  $request->aed_value;
            $item->sqft_size =  $request->sqft_size;
            $item->meeting_room =  $request->meeting_room;
            $item->conference_room =  $request->conference_room;
            $item->fully_furnished =  $request->fully_furnished;
            $item->address =  $request->address;
            $item->lat =  $request->lat;
            $item->lng =  $request->lng;
            if($request->file('pma_agreement')){
                $file = $request->file('pma_agreement');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('pma-agreement/resources', $filename);
                $file = '/pma-agreement/resources/' . $filename;
                $item->pma_agreement = $file;
            }
            $item->save();
            return  Redirect(route('properties.index'))->with('success', 'Property Created Successfully');
        } catch (Exception $e) {
            return  Redirect(route('properties.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        if(!auth()->guard('admin')->user()->can('write-properties')) {
            return abort(404);
        }
        $property = Property::where('id', $id)->first();
        return view('admin.properties.add-edit')->with('item', $property);
    }

    public function update(Request $request, $id)
    {

        $item = Property::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'pma_contract_start_date' => 'required',
            'pma_contract_end_date' => 'required',
            'aed_value' => 'required',
            'sqft_size' => 'required',
            'conference_room' => 'required',
            'fully_furnished' => 'required',
            'address' => 'required',
            'pma_agreement' => 'nullable|mimes:pdf',
            'lat' => 'required'
        ], [
            'lat.required' => "Please Chose Location"
        ]);
        try {
            $item->name =  $request->name;
            $item->location =  $request->location;
            $item->pma_contract_start_date =  $request->pma_contract_start_date;
            $item->pma_contract_end_date =  $request->pma_contract_end_date;
            $item->aed_value =  $request->aed_value;
            $item->sqft_size =  $request->sqft_size;
            $item->meeting_room =  $request->meeting_room;
            $item->conference_room =  $request->conference_room;
            $item->fully_furnished =  $request->fully_furnished;
            $item->address =  $request->address;
            $item->lat =  $request->lat;
            $item->lng =  $request->lng;
            if($request->file('pma_agreement')){
                $file = $request->file('pma_agreement');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('pma-agreement/resources', $filename);
                $file = '/pma-agreement/resources/' . $filename;
                $item->pma_agreement = $file;
            }
            $item->save();

            return  Redirect(route('properties.index'))->with('success', 'Property Updatd Successfully');
        } catch (Exception $e) {
            return  Redirect(route('properties.edit', ['property' => $id]))->with('error', 'Facing Error!');
        }
    }

    public function destroy($id)
    {
        if(!auth()->guard('admin')->user()->can('delete-properties')) {
            return abort(404);
        }
        try {
            PropertyUnit::where('property_id', $id)->delete();
            Property::findOrFail($id)->delete();
            return Redirect(route('properties.index'))->with('success', 'Property Archived Successfully');
        } catch (Exception $e) {
            return Redirect(route('properties.index'))->with('error', $e->getMessage());
        }
    }

    public function restore($id) {
        if(!auth()->guard('admin')->user()->can('delete-properties')) {
            return abort(404);
        }
        try {
            // dd($id);
            Property::where('id', $id)->restore();
            return Redirect()->back()->with('success', 'Property Unarchived Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function permanentDelete($id) {
        if(!auth()->guard('admin')->user()->can('delete-properties')) {
            return abort(404);
        }
        try {
            if(PropertyUnit::where('property_id', $id)->withTrashed()->count() > 0) {
                return Redirect()->back()->with('error', "This property is assigned with units. You should need to delete all units before you delete property.");
            }
            Property::where('id', $id)->forceDelete();
            return Redirect()->back()->with('success', 'Property Deleted Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }
}
