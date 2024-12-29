<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('user.profile.paymentmethod.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('user.profile.paymentmethod.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:debit,e_wallet',
            'account_number' => 'nullable|required_if:payment_method,debit|string',
            'phone_number' => 'nullable|required_if:payment_method,e_wallet|string',
            'bank_name' => 'nullable|required_if:payment_method,debit|string',
            'e_wallet_name' => 'nullable|required_if:payment_method,e_wallet|string',
        ]);

        $request->merge(['user_id' => auth()->id()]); // Tambahkan user_id dari user yang login

        PaymentMethod::create($request->all());

        return redirect()->route('user.profile.paymentmethod.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('user.profile.paymentmethod.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'payment_method' => 'required|in:debit,e_wallet',
            'account_number' => 'nullable|required_if:payment_method,debit|string',
            'phone_number' => 'nullable|required_if:payment_method,e_wallet|string',
            'bank_name' => 'nullable|required_if:payment_method,debit|string',
            'e_wallet_name' => 'nullable|required_if:payment_method,e_wallet|string',
        ]);

        $paymentMethod->update($request->all());

        return redirect()->route('user.profile.paymentmethod.index')->with('success', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return redirect()->route('user.profile.paymentmethod.index')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}