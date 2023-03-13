<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\QuotationMail;
use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->guard('admin')->user()->can('read-quote-requests')) {
            return abort(404);
        }
        $query = Quotation::query()->where('status',  'pending')->orWhere('status',  'viewed');
         if($request->type == 'archived') {
            $query->onlyTrashed();
         }
        $data = $query->get();

        $query = Quotation::query()->where('status','rejected');
         if($request->type == 'rejected_archived') {
            $query->onlyTrashed();
         }
        $rejected = $query->get();
        $archived = Quotation::where('status',  'pending')->orWhere('status',  'viewed')->onlyTrashed()->count();
        $archived_rejected = Quotation::where('status', 'rejected')->onlyTrashed()->count();
        $active = Quotation::where('status',  'pending')->orWhere('status',  'viewed')->count();
        return view('admin.quotations.index', compact('data'))->with('archived', $archived)->with('active',  $active)->with('rejected', $rejected)->with('archived_rejected', $archived_rejected);
    }

    public function show($quotation) {
        if(!auth()->guard('admin')->user()->can('read-quote-requests')) {
            return abort(404);
        }
        $Quotation = Quotation::with('property:id,name','items')->where('id', $quotation)->first();
        return view('admin.quotations.view')->with('item', $Quotation);
    }

    public function create()
    {
        if(!auth()->guard('admin')->user()->can('write-quote-requests')) {
            return abort(404);
        }
        $Quotation = new Quotation();
        $properties = Property::select('id', 'name')->get();
        $units = [];
        $quotation_unit_ids= [];
        return view('admin.quotations.add-edit')->with('item', $Quotation)->with('properties', $properties)->with('quotation_unit_ids', $quotation_unit_ids)->with('units', $units);
    }

    public function store(Request $request)
    {
        $request->validate([
            'property' => 'required',
            'company' => 'required|unique:property_units,unit_id',
            'client_name' => 'required',
            'quotation_validity' => 'required',
            'client_telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
            'client_email' => 'required|email',
            'units' => 'required|array|min:1',
        ]);
        try {
            $item = new Quotation();
            $item->property_id = $request->property;
            $item->admin_id = auth()->guard('admin')->id();
            $item->company =  $request->company;
            $item->client_name =  $request->client_name;
            $item->quotation_validity =  $request->quotation_validity;
            $item->client_telephone =  $request->client_telephone;
            $item->client_email =  $request->client_email;
            $item->quotation_number =  date('mdyhms');
            $item->save();
            if (isset($request->units) && count($request->units)) {
                $create = [];
                foreach ($request->input('units') as $key => $data) {
                    foreach ($data as $value_key => $value) {
                        $create[$value_key][$key] =  $value;
                    }
                }
                $itemIds = [];
                foreach ($create as $quotation) {
                    $unit = PropertyUnit::find($quotation['unit_id']);
                    $quoteItem = isset($quotation['id']) && $quotation['id'] != null ? QuotationItem::find($quotation['id']) : new QuotationItem();
                    $quoteItem->payment_term = $quotation['term'];
                    $quoteItem->amount = $unit[$quotation['term']];
                    $quoteItem->property_unit_id = $quotation['unit_id'];
                    $quoteItem->quotation_id = $item->id;
                    $quoteItem->save();
                    array_push($itemIds, $quoteItem->id);
                }
                QuotationItem::where('quotation_id', $item->id)->whereNotIn('id', $itemIds)->forceDelete();
            }
            $data = [
                'client_name' => $request->client_name,
                'number' => $item->quotation_number,
                'token' => Crypt::encrypt($request->client_email),
                'days' => $request->quotation_validity,
                'status' => $item->status
            ];
            Mail::to($request->client_email)->send(new QuotationMail($data));
            return response()->json(['data' => 'Quotation Created Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    public function edit($id)
    {
        if(!auth()->guard('admin')->user()->can('write-quote-requests')) {
            return abort(404);
        }
        $quotation = Quotation::where('id', $id)->first();
        $properties = Property::select('id', 'name')->get();
        $units = PropertyUnit::where('property_id', $quotation->property_id)->get();
        $items =  $quotation->items()->with('unit')->get();
        $quotation_unit_ids = $items->pluck('property_unit_id')->toArray();

        return view('admin.quotations.add-edit')->with('item', $quotation)->with('properties', $properties)->with('units', $units)->with('items', $items)->with('quotation_unit_ids', $quotation_unit_ids);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $item = Quotation::findOrFail($id);
        $request->validate([
            'property' => 'required',
            'company' => 'required|unique:property_units,unit_id',
            'client_name' => 'required',
            'quotation_validity' => 'required',
            'client_telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13|max:15',
            'client_email' => 'required|email',
            'units' => 'required|array|min:1',
        ]);
        try {
            $item->property_id = $request->property;
            $item->admin_id = auth()->guard('admin')->id();
            $item->company =  $request->company;
            $item->client_name =  $request->client_name;
            $item->quotation_validity =  $request->quotation_validity;
            $item->client_telephone =  $request->client_telephone;
            $item->client_email =  $request->client_email;
            $item->save();
            if (isset($request->units) && count($request->units)) {
                $create = [];
                foreach ($request->input('units') as $key => $data) {
                    foreach ($data as $value_key => $value) {
                        $create[$value_key][$key] =  $value;
                    }
                }
                // dd($create);
                $itemIds = [];
                foreach ($create as $quotation) {
                    $unit = PropertyUnit::find($quotation['unit_id']);
                    $quoteItem = isset($quotation['id']) && $quotation['id'] != null ? QuotationItem::find($quotation['id']) : new QuotationItem();
                    $quoteItem->payment_term = $quotation['term'];
                    $quoteItem->amount = $unit[$quotation['term']];
                    $quoteItem->property_unit_id = $quotation['unit_id'];
                    $quoteItem->quotation_id = $item->id;
                    $quoteItem->save();
                    array_push($itemIds, $quoteItem->id);
                }
                QuotationItem::where('quotation_id', $item->id)->whereNotIn('id', $itemIds)->forceDelete();
            }
            $data = [
                'client_name' => $request->client_name,
                'number' => $item->quotation_number,
                'token' => Crypt::encrypt($request->client_email),
                'days' => $request->quotation_validity,
                'status' => $item->status
            ];
            Mail::to($request->client_email)->send(new QuotationMail($data));
            return response()->json(['data' => 'Quotation Updated Successfully'], 200);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);

        }
    }

    public function destroy($id)
    {
        if(!auth()->guard('admin')->user()->can('delete-quote-requests')) {
            return abort(404);
        }
        try {
            Quotation::findOrFail($id)->delete();
            return Redirect()->back()->with('success', 'Quotation Archived Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function restore($id) {
        if(!auth()->guard('admin')->user()->can('delete-quote-requests')) {
            return abort(404);
        }
        try {
            // dd($id);
            Quotation::where('id', $id)->restore();
            return Redirect()->back()->with('success', 'Quotation Unarchived Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function permanentDelete($id) {
        try {
            if(!auth()->guard('admin')->user()->can('delete-quote-requests')) {
                return abort(404);
            }
            // dd($id);
            Quotation::where('id', $id)->forceDelete();
            return Redirect()->back()->with('success', 'Quotation Deleted Successfully');
        } catch (Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getUnits(Request $request) {
        $data['units'] = PropertyUnit::where('property_id', $request->property)->get();
        return response()->json($data);
    }

    public function approved(Request $request)
    {
        if(!auth()->guard('admin')->user()->can('read-quote-requests')) {
            return abort(404);
        }
        $query = Quotation::query()->where('status',  'approved');
         if($request->type == 'archived') {
            $query->onlyTrashed();
         }
        $data = $query->get();

        $archived = Quotation::where('status', 'approved')->onlyTrashed()->count();
        return view('admin.quotations.approved', compact('data'))->with('archived', $archived);
    }
}
