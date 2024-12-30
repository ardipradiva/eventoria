<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\Ticket;

class PaymentController extends Controller
{
    // public function index()
    // {
    //     $payments = Payment::all();
    //     return response()->json($payments);
    // }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'amount' => 'required|numeric',
    //         'description' => 'required|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $payment = Payment::create($request->all());
    //     return response()->json($payment, 201);
    // }

    // public function show($id)
    // {
    //     $payment = Payment::find($id);

    //     if (is_null($payment)) {
    //         return response()->json(['message' => 'Payment not found'], 404);
    //     }

    //     return response()->json($payment);
    // }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'amount' => 'numeric',
    //         'description' => 'string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $payment = Payment::find($id);

    //     if (is_null($payment)) {
    //         return response()->json(['message' => 'Payment not found'], 404);
    //     }

    //     $payment->update($request->all());
    //     return response()->json($payment);
    // }

    // public function destroy($id)
    // {
    //     $payment = Payment::find($id);

    //     if (is_null($payment)) {
    //         return response()->json(['message' => 'Payment not found'], 404);
    //     }

    //     $payment->delete();
    //     return response()->json(['message' => 'Payment deleted successfully']);
    // }

    public function payment($id)
    {
        // Ambil data event
        $event = Event::findOrFail($id);

        // Ambil data nama dan email dari session
        $name = session('name');
        $email = session('email');

        // Ambil metode pembayaran user saat ini
        $user = User::where('email', $email)->firstOrFail();
        $payment_methods = PaymentMethod::where('user_id', $user->id)->pluck('payment_method');

        

        return view('user.event.payment', compact('event', 'name', 'email', 'payment_methods'));
    }

    public function store(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        Ticket::create([
            'name' => session('name'),
            'email' => session('email'),
            'event_name' => $event->event_name,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Tiket sudah dibeli!');
    }

}
