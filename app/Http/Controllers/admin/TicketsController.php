<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\Tickets\AdminCloseTicket;
use App\Mail\Tickets\ClientCloseTicket;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    public function index() {
      $data = Ticket::with('user')->where('status', 'open')->orderBy('id', 'DESC')->get();
      $closed = Ticket::with(['user:id,name', 'admin:id,name'])->where('status', 'closed')->orderBy('id', 'DESC')->get();
      return view('admin.tickets.index')->with('data', $data)->with('closed', $closed);
    }

    public function show($ticket) {
        $ticket = Ticket::where('id', $ticket)->with(['user:id,name', 'admin:id,name'])->first();
        return view('admin.tickets.show')->with('item', $ticket);
    }

    public function update(Request $request, $ticket) {
        $ticket = Ticket::find($ticket);
        $request->validate([
            'reply' => 'required'
        ]);

        $ticket->reply = $request->reply;
        $ticket->admin_id = auth()->guard('admin')->id();
        $ticket->status = 'closed';
        $data = [
            'ticket_number' => $ticket->ticket_number,
            'title' => $ticket->title,
            'id' => $ticket->id,
            'description' => $ticket->description,
            'reply' => $ticket->reply,
            'client_name' => auth()->user()->name,
            'admin_name' => Admin::where('id', $ticket->admin_id)->pluck('name')->first()
        ];
        $user = User::where('id', $ticket->user_id)->pluck('email')->first();
        $admin = Admin::first()->pluck('email');
        Mail::to($user)->send(new ClientCloseTicket($data));
        Mail::to($admin)->send(new AdminCloseTicket($data));
        if($ticket->save()) {
            return  Redirect()->back()->with('success', 'Ticket Closed Successfully');
        } else {
            return  Redirect()->back()->with('error', 'Facing error try again');
        }
    }

    public function destroy($ticket) {
      $ticket = Ticket::find($ticket);
      if($ticket->delete()) {
        return  Redirect()->back()->with('success', 'Ticket Deleted Successfully');
      } else {
        return  Redirect()->back()->with('error', 'Facing error try again');
      }
    }
}
