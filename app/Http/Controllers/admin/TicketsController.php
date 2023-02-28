<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index() {
      $data = Ticket::with('user')->where('status', 'open')->orderBy('id', 'DESC')->get();
      $closed = Ticket::with(['user:id,name', 'admin:id,name'])->where('status', 'closed')->orderBy('id', 'DESC')->get();
      return view('admin.tickets.index')->with('data', $data)->with('closed', $closed);
    }

    public function show($ticket) {
        $ticket = Ticket::with(['user:id,name', 'admin:id,name'])->first();
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
