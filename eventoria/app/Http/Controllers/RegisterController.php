<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function create(){
        $nav = 'Register';
        
        return view('user.event.register',compact('nav'));
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
