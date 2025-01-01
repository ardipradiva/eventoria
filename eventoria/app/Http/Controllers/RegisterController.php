<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Pastikan model Event sudah diimpor

class RegisterController extends Controller
{
    public function create($id)
    {
        // Ambil data event berdasarkan ID
        $event = Event::findOrFail($id);

        return view('user.event.register', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        session([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.event.payment', $eventId);
    }
}
