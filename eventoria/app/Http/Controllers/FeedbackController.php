<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $feedback = Ticket::all();
        return view('feedback.index', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $nav = 'Tambah Feedback';
        return view('feedback.create', compact('nav'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validated([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        Feedback::create($validatedData);
        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $feedback = Feedback::findOrFail($id);
        return view('feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $feedback = Feedback::findOrFail($id);
        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validated([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        Feedback::findOrFail($id)->update($validatedData);
        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Feedback::findOrFail($id)->delete();
        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus');
    }
}