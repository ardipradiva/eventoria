<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $feedback = Feedback::where('user_id', auth()->id())->get();
        return view('user.feedback.index', compact('feedback'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $nav = 'Tambah Feedback';
        return view('user.feedback.create', compact('nav'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        
        // Tambahkan user_id secara manual
        $validatedData['user_id'] = auth()->id();
    
        // Simpan data ke database
        Feedback::create($validatedData);
    
        return redirect()->route('user.feedback.index')->with('success', 'Feedback berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $feedback = Feedback::findOrFail($id);
        return view('user.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $feedback = Feedback::findOrFail($id);
        return view('user.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
    
        // Temukan feedback berdasarkan ID dan update
        $feedback = Feedback::findOrFail($id);
        $feedback->update($validatedData);
    
        return redirect()->route('user.feedback.index')->with('success', 'Feedback berhasil diubah');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Feedback::findOrFail($id)->delete();
        return redirect()->route('user.feedback.index')->with('success', 'Feedback berhasil dihapus');
    }
}