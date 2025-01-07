<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; 
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
