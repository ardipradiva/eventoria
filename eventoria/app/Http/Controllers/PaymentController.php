<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $payment = Payment::create($request->all());
        return response()->json($payment, 201);
    }

    public function show($id)
    {
        $payment = Payment::find($id);

        if (is_null($payment)) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json($payment);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'numeric',
            'description' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $payment = Payment::find($id);

        if (is_null($payment)) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update($request->all());
        return response()->json($payment);
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (is_null($payment)) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
