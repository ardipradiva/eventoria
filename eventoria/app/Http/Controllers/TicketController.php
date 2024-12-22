<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; 

class Ticketcontroller extends Controller 
{
    public function index()
    {
        $events = Event::all();
        return view('ticket.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('ticket.show', compact('event'));
    }

    public function create($id)
    {
        $event = Event::findOrFail($id);
        return view('ticket.create', compact('event'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'event_name' => 'required|string',
        ]);

        $event = Event::findOrFail($id);
        $event->tickets()->create($request->all());

        return redirect()->route('ticket.index')->with('success', 'Tiket berhasil dibeli');
    }

    public function destroy($id, $ticketId)
    {
        $event = Event::findOrFail($id);
        $event->tickets()->findOrFail($ticketId)->delete();

        return redirect()->route('ticket.index')->with('success', 'Tiket berhasil dihapus');
    }

    public function edit($id, $ticketId)
    {
        $event = Event::findOrFail($id);
        $ticket = $event->tickets()->findOrFail($ticketId);

        return view('ticket.edit', compact('event', 'ticket'));
    }

    public function update(Request $request, $id, $ticketId)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'event_name' => 'required|string',
        ]);

        $event = Event::findOrFail($id);
        $ticket = $event->tickets()->findOrFail($ticketId);
        $ticket->update($request->all());

        return redirect()->route('ticket.index')->with('success', 'Tiket berhasil diubah');
    }
}
