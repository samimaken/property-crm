<?php

namespace App\Http\Controllers;

use App\Mail\Tickets\ClientOpenTicket;
use App\Mail\Tickets\ClientTicket;
use App\Models\Admin;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            $data = [
                'ticket_number' => $item->ticket_number,
                'title' => $item->title,
                'id' => $item->id,
                'client_name' => auth()->user()->name
            ];
            $admins = Admin::whereHas('permissions', function($q) {
                     return $q->where('name', 'read-tickets');
            })->get()->pluck('email')->toArray();
            Mail::to(auth()->user()->email)->send(new ClientTicket($data));
            foreach($admins as $admin) {
            Mail::to($admin)->send(new ClientOpenTicket($data));
            }
            return  Redirect(route('client-tickets.index'))->with('success', 'Ticket Submitted Successfully');

    }


}
