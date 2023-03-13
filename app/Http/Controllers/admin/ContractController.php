<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\PropertyUnit;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function store(Request $request, $quotation) {
        // dd($request->all());
        $request->validate([
            'items' => 'array',
            'items.*.start_date' => 'required',
            'items.*.end_date' => 'required',
            'items.*.payment_term' => 'required',
            'items.*.initial_percentage' => 'required_if:items.*.payment_term,unit_price_1,unit_price_2',
            'items.*.second_payment_date' => 'required_if:items.*.payment_term,unit_price_1,unit_price_2',
            'items.*.payment_method' => 'required_if:items.*.payment_term,unit_price_1,unit_price_2',
        ], $this->messages($request));
        $quotation = Quotation::find($quotation);
        foreach($request->items as $item) {

            $startDate = Carbon::parse($item['start_date']);
            $endDate = Carbon::parse($item['end_date']);
            $diff = $startDate->diffInYears($endDate);
            dd($diff);

            $unit = PropertyUnit::find($item['property_unit_id']);
            $contract = new Contract();
            $contract->quotation_id = $quotation;
            $contract->quotation_id = $item['property_unit_id'];
            $contract->contract_number = date('Ymdhis');
            $contract->start_date = $item['start_date'];
            $contract->end_date = $item['end_date'];
            $contract->security_deposit = $unit['deposit_amount'];
            $contract->vat = 0;
            $contract->total_amount = 0;
            $contract->grand_amount = 0;
            $contract->total_amount = 0;
            $contract->status = 'pending';

            if($item['payment_term'] == 'unit_price_monthly') {
                $contract->no_of_months = 0;
            } else {

                $contract->second_payment_date = $item['second_payment_date'];
                $contract->initial_percentage = $item['initial_percentage'];
                $contract->payment_method = $item['payment_method'];
                $contract->no_of_years = 0;
            }
        }
    }

    public function messages($request)
    {
        $messages = [];
        foreach($request->items as $key => $item) {
            foreach($item as $field => $value) {
                if($field == 'start_date') {
                    $messages['items.' . $key .'.'.$field.'.required'] = 'Start Date is required';
                }
                if($field == 'end_date') {
                    $messages['items.' . $key .'.'.$field.'.required'] = 'End Date is required';
                }
                if($field == 'initial_percentage') {
                    $messages['items.' . $key .'.'.$field.'.required_if'] = 'Initial Percentage is required';
                }
                if($field == 'second_payment_date') {
                    $messages['items.' . $key .'.'.$field.'.required_if'] = 'Second Payment Date is required';
                }
                if($field == 'payment_method') {
                    $messages['items.' . $key .'.'.$field.'.required_if'] = 'Payment Method is required';
                }
            }
        }
        return $messages;
    }
}
