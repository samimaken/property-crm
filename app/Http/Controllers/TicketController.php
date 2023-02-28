<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $data = Ticket::where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
        return view('tickets.index')->with('data', $data);
    }

    public function show($ticket)
    {
        $ticket = Ticket::findOrFail($ticket);
        if($ticket->user_id != auth()->id()) {
            return abort(404);
        }
        return view('tickets.show')->with('item', $ticket);
    }

    public function create()
    {

        $ticket = new Ticket();
        return view('tickets.add-edit')->with('item', $ticket);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,png',
        ]);
        try {
            $item = new Ticket();
            $item->title =  $request->title;
            $item->description =  $request->description;
            $item->ticket_number =  '#'.date('ymdhis');
            $item->user_id = auth()->id();
            if($request->file('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->move('tickets/images', $filename);
                $file = '/tickets/images/' . $filename;
                $item->image = $file;
            }
            $item->save();
            return  Redirect(route('client-tickets.index'))->with('success', 'Ticket Submitted Successfully');
        } catch (Exception $e) {
            return  Redirect(route('client-tickets.create'))->with('error', $e->getMessage());
        }
    }


}
