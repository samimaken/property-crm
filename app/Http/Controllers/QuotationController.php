<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class QuotationController extends Controller
{
    public function index()
    {
    }

    public function show(Request $request, $number)
    {
        $quotation = Quotation::with(['items.unit', 'property:id,name,address'])->where('quotation_number', $number)->first();
        if ($quotation == null) {
            return abort(404);
        }
        if ($request->token) {
            $email = Crypt::decrypt($request->token);

            if($email == $quotation->client_email) {
                if($quotation->status == 'pending') {
                $quotation->status = 'viewed';
                $quotation->save();
                }
                return view('quotation')->with('item', $quotation);
            }
             else {
                return abort(404);
             }
        } else if (Auth::guard('admin')->check()) {
            return view('quotation')->with('item', $quotation);
        } else if (Auth::check()) {
            $user = auth()->user();
            if ($user->email == $quotation->client_email) {
                $quotation->status = 'viewed';
                $quotation->save();
                return view('quotation')->with('item', $quotation);
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function rejectQuote(Request $request, $number)
    {
        $quotation = Quotation::where('quotation_number', $number)->first();
        if ($quotation == null) {
            return abort(404);
        }
        if ($request->token) {
            $email = Crypt::decrypt($request->token);
            if($email == $quotation->client_email) {
                $quotation->status = 'rejected';
                $quotation->save();
                return  Redirect()->back()->with('success', 'Quotation Rejected Successfully');
            }
             else {
                return abort(404);
             }
        }  else if (Auth::guard('web')->check()) {
            $user = auth()->user();
            if ($user->email == $quotation->client_email) {
                $quotation->status = 'rejected';
                $quotation->save();
                return  Redirect()->back()->with('success', 'Quotation Rejected Successfully');
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }
}
