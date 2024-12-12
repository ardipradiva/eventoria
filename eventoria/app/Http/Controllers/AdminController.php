<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Carbon\Carbon;

class Admincontroller extends Controller
{

    public function dashboard()
    {
        $totalEvents = \App\Models\Event::count();
        $totalUsers = \App\Models\User::count();
        $registrationsToday = \App\Models\Event::whereDate('created_at', now()->toDateString())->count();
        $events = \App\Models\Event::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalEvents', 'totalUsers', 'registrationsToday', 'events'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::all();
        return view('admin.event.index', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $nav = 'Tambah Event';
        return view('admin.event.create', compact('nav'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreEventRequest $request)
    // {
    //     //
    //     $validatedData = $request-> validated();
    //     $imagePath = $request->file('event_image')->store('event_images', 'public');
    //     Event::create($validatedData);
    //     return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan');
    // }

    

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_location' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'event_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'event_price' => 'required|numeric',
            'event_provider' => 'required|string',
        ]);

        // Gabungkan tanggal dan waktu
        $eventDateTime = Carbon::parse($request->event_date . ' ' . $request->event_time);

        // Menyimpan event baru
        Event::create([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_location' => $request->event_location,
            'event_date' => $eventDateTime, // Simpan sebagai datetime
            'event_price' => $request->event_price,
            'event_provider' => $request->event_provider,
            'event_image' => $request->file('event_image')->store('events', 'public'), // Gambar
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data event berdasarkan ID
        $event = Event::findOrFail($id);

        // Kirim data event ke view 'show'
        return view('admin.event.show', compact('event'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // Pastikan event_date adalah objek Carbon
        $event->event_date = Carbon::parse($event->event_date);

        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'event_name' => 'required|string|max:255',
        'event_description' => 'required|string',
        'event_location' => 'required|string',
        'event_date' => 'required|date',
        'event_time' => 'required|date_format:H:i',
        'event_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'event_price' => 'required|numeric',
        'event_provider' => 'required|string',
    ]);

    // Gabungkan tanggal dan waktu
    $eventDateTime = Carbon::parse($request->event_date . ' ' . $request->event_time);

    // Update data event
    $event->update([
        'event_name' => $request->event_name,
        'event_description' => $request->event_description,
        'event_location' => $request->event_location,
        'event_date' => $eventDateTime,
        'event_price' => $request->event_price,
        'event_provider' => $request->event_provider,
        // Menangani update gambar jika ada file baru
        'event_image' => $request->hasFile('event_image') ? $request->file('event_image')->store('events', 'public') : $event->event_image,
    ]);

    return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus');
    }
}
