<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyUnit;
use Exception;
use Illuminate\Http\Request;

class PropertyUnitController extends Controller
{
    public function __construct()
    {
         if(isset(request()->property) && Property::find(request()->property) == null) {
            return abort(404);
         }
    }
    public function index(Request $request, $property)
    {
        if(!auth()->guard('admin')->user()->can('read-units')) {
            return abort(404);
        }
        $query = PropertyUnit::query()->where('property_id', $property);
         if($request->type == 'archived') {
            $query->onlyTrashed();
         }
        $data = $query->get();
        $archived = PropertyUnit::onlyTrashed()->count();
        $active = PropertyUnit::count();
        $propertyData = Property::where('id', $property)->select('id', 'name')->first();
        return view('admin.units.index', compact('data'))->with('archived', $archived)->with('propertyData' , $propertyData)->with('active',  $active);
    }

    public function show($property, $unit) {
        if(!auth()->guard('admin')->user()->can('read-units')) {
            return abort(404);
        }
        $propertyUnit = PropertyUnit::with('property:id,name')->where('id', $unit)->first();
        return view('admin.units.show')->with('item', $propertyUnit);
    }

    public function create($property)
    {
        if(!auth()->guard('admin')->user()->can('write-units')) {
            return abort(404);
        }
        $propertyUnit = new PropertyUnit();
        $propertyData = Property::where('id', $property)->select('id', 'name')->first();
        return view('admin.units.add-edit')->with('item', $propertyUnit)->with('propertyData', $propertyData);
    }

    public function store(Request $request, $property)
    {
        $request->validate([
            'type' => 'required',
            'unit_id' => 'required|unique:property_units,unit_id',
            'tawtheeq_id' => 'required',
            'sqft_size' => 'required',
            'desks_allocated' => 'required',
            'furnished' => 'required',
            'unit_price_1' => 'required',
            'unit_price_2' => 'required',
            'unit_price_monthly' => 'required',
            'deposit_amount' => 'required',
            'image1' => 'nullable|mimes:jpeg,jpg,png',
            'image2' => 'nullable|mimes:jpeg,jpg,png',
            'image3' => 'nullable|mimes:jpeg,jpg,png',
            'image4' => 'nullable|mimes:jpeg,jpg,png',
        ]);
        try {
            $item = new PropertyUnit();
            $item->property_id = $property;
            $item->type =  $request->type;
            $item->unit_id =  $request->unit_id;
            $item->tawtheeq_id =  $request->tawtheeq_id;
            $item->sqft_size =  $request->sqft_size;
            $item->desks_allocated =  $request->desks_allocated;
            $item->furnished =  $request->furnished;
            $item->unit_price_1 =  $request->unit_price_1;
            $item->unit_price_2 =  $request->unit_price_2;
            $item->unit_price_monthly =  $request->unit_price_monthly;
            $item->deposit_amount =  $request->deposit_amount;
            if($request->file('image1')){
                $file = $request->file('image1');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image1 = $file;
            }
            if($request->file('image2')){
                $file = $request->file('image2');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image2 = $file;
            }
            if($request->file('image3')){
                $file = $request->file('image3');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image3 = $file;
            }
            if($request->file('image4')){
                $file = $request->file('image4');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image4 = $file;
            }
            $item->save();
            return  Redirect(route('units.index', ['property' => $property]))->with('success', 'PropertyUnit Created Successfully');
        } catch (Exception $e) {
            return  Redirect(route('units.create', ['property' => $property]))->with('error', $e->getMessage());
        }
    }

    public function edit($property, $id)
    {
        if(!auth()->guard('admin')->user()->can('write-units')) {
            return abort(404);
        }
        $propertyUnit = PropertyUnit::where('id', $id)->first();
        $propertyData = Property::where('id', $property)->select('id', 'name')->first();
        return view('admin.units.add-edit')->with('item', $propertyUnit)->with('propertyData', $propertyData);
    }

    public function update(Request $request, $property, $id)
    {

        $item = PropertyUnit::findOrFail($id);
        $request->validate([
            'type' => 'required',
            'unit_id' => 'required|unique:property_units,unit_id,'.$id,
            'tawtheeq_id' => 'required',
            'sqft_size' => 'required',
            'desks_allocated' => 'required',
            'furnished' => 'required',
            'unit_price_1' => 'required',
            'unit_price_2' => 'required',
            'unit_price_monthly' => 'required',
            'deposit_amount' => 'required',
            'image1' => 'nullable|mimes:jpeg,jpg,png',
            'image2' => 'nullable|mimes:jpeg,jpg,png',
            'image3' => 'nullable|mimes:jpeg,jpg,png',
            'image4' => 'nullable|mimes:jpeg,jpg,png']
        );
        try {
            $item->property_id = $property;
            $item->type =  $request->type;
            $item->unit_id =  $request->unit_id;
            $item->tawtheeq_id =  $request->tawtheeq_id;
            $item->sqft_size =  $request->sqft_size;
            $item->desks_allocated =  $request->desks_allocated;
            $item->furnished =  $request->furnished;
            $item->unit_price_1 =  $request->unit_price_1;
            $item->unit_price_2 =  $request->unit_price_2;
            $item->unit_price_monthly =  $request->unit_price_monthly;
            $item->deposit_amount =  $request->deposit_amount;
            if($request->file('image1')){
                $file = $request->file('image1');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image1 = $file;
            }
            if($request->file('image2')){
                $file = $request->file('image2');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image2 = $file;
            }
            if($request->file('image3')){
                $file = $request->file('image3');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image3 = $file;
            }
            if($request->file('image4')){
                $file = $request->file('image4');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('units/mages', $filename);
                $file = '/units/mages/' . $filename;
                $item->image4 = $file;
            }
            $item->save();

            return  Redirect(route('units.index', ['property' => $property]))->with('success', 'PropertyUnit Updatd Successfully');
        } catch (Exception $e) {
            return  Redirect(route('units.edit', ['property' =>  $property, 'unit' => $id]))->with('error', 'Facing Error!');
        }
    }

    public function destroy($property, $id)
    {
        if(!auth()->guard('admin')->user()->can('delete-units')) {
            return abort(404);
        }
        try {
            PropertyUnit::findOrFail($id)->delete();
            return Redirect(route('units.index', ['property' => $property]))->with('success', 'PropertyUnit Archived Successfully');
        } catch (Exception $e) {
            return Redirect(route('units.index', ['property' => $property]))->with('error', $e->getMessage());
        }
    }

    public function restore($property, $id) {
        if(!auth()->guard('admin')->user()->can('delete-units')) {
            return abort(404);
        }
        try {
            // dd($id);
            PropertyUnit::where('id', $id)->restore();
            return Redirect()->back()->with('success', 'PropertyUnit Unarchived Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function permanentDelete($property, $id) {
        try {
            if(!auth()->guard('admin')->user()->can('delete-units')) {
                return abort(404);
            }
            // dd($id);
            PropertyUnit::where('id', $id)->forceDelete();
            return Redirect()->back()->with('success', 'PropertyUnit Deleted Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }
}
