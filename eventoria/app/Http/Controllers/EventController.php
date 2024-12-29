<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class EventController extends Controller
{
    // Method untuk dashboard
    public function dashboard()
    {
        $user = auth()->user();
        $events = Event::latest()->take(5)->get(); // Menampilkan 5 event terbaru
        foreach ($events as $event) {
            $event->event_date = Carbon::parse($event->event_date);
        }
        return view('user.dashboard', compact('user', 'events'));
    }

    // Method untuk profile
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile.profile', compact('user'));
    }

    // Method untuk cart
    public function cart()
    {
        // Logic untuk cart
        return view('user.cart');
    }

    // Method untuk history
    public function history()
    {
        // Logic untuk history
        return view('user.history');
    }

    // Method untuk melihat semua event
    public function events()
    {
        $events = Event::all();
        return view('user.events', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('user.event.show', compact('event'));
    }
}
