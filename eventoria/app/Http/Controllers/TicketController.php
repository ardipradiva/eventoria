<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; 

// class Ticketcontroller extends Controller 
// {
//     public function index()
//     {
//         $events = Event::all();
//         return view('ticket.index', compact('events'));
//     }

//     public function show($id)
//     {
//         $event = Event::findOrFail($id);
//         return view('ticket.show', compact('event'));
//     }

//     public function create($id)
//     {
//         $event = Event::findOrFail($id);
//         return view('ticket.create', compact('event'));
//     }

//     public function store(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required|string',
//             'email' => 'required|email',
//             'event_name' => 'required|string',
//         ]);

//         $event = Event::findOrFail($id);
//         $event->tickets()->create($request->all());

//         return redirect()->route('ticket.index')->with('success', 'Tiket berhasil dibeli');
//     }

//     public function destroy($id, $ticketId)
//     {
//         $event = Event::findOrFail($id);
//         $event->tickets()->findOrFail($ticketId)->delete();

//         return redirect()->route('ticket.index')->with('success', 'Tiket berhasil dihapus');
//     }

//     public function edit($id, $ticketId)
//     {
//         $event = Event::findOrFail($id);
//         $ticket = $event->tickets()->findOrFail($ticketId);

//         return view('ticket.edit', compact('event', 'ticket'));
//     }

//     public function update(Request $request, $id, $ticketId)
//     {
//         $request->validate([
//             'name' => 'required|string',
//             'email' => 'required|email',
//             'event_name' => 'required|string',
//         ]);

//         $event = Event::findOrFail($id);
//         $ticket = $event->tickets()->findOrFail($ticketId);
//         $ticket->update($request->all());

//         return redirect()->route('ticket.index')->with('success', 'Tiket berhasil diubah');
//     }
// }

use App\Models\Ticket;
use PDF;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('email', auth()->id())->get();
        return view('user.history.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('user.history.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('user.history.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->only('name', 'email'));

        return redirect()->route('user.history.index')->with('success', 'Tiket berhasil diperbarui');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('user.history.index')->with('success', 'Tiket berhasil dibatalkan');
    }

    public function print($id)
    {
        $ticket = Ticket::findOrFail($id);
        $pdf = PDF::loadView('user.history.pdf', compact('ticket'));
        return $pdf->download('tiket-' . $ticket->id . '.pdf');
    }

    public function filter(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $tickets = Ticket::where('name', $request->name)
            ->where('email', $request->email)
            ->get();

        return view('user.history.index', compact('tickets'));
    }

}
