<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    // Fungsi untuk menampilkan semua metode pembayaran yang dimiliki oleh pengguna
    public function index()
    {
        $paymentMethods = PaymentMethod::all(); // Mengambil semua data metode pembayaran dari database
        return view('user.profile.paymentmethod.index', compact('paymentMethods')); // Mengirim data ke view
    }

    // Fungsi untuk menampilkan form pembuatan metode pembayaran baru
    public function create()
    {
        return view('user.profile.paymentmethod.create'); // Mengarahkan ke halaman form create metode pembayaran
    }

    // Fungsi untuk menyimpan data metode pembayaran baru ke database
    public function store(Request $request)
    {
        // Validasi input berdasarkan tipe metode pembayaran
        $request->validate([
            'payment_method' => 'required|in:debit,e_wallet', // Wajib memilih metode debit atau e-wallet
            'account_number' => 'nullable|required_if:payment_method,debit|string', // Wajib diisi jika metode adalah debit
            'phone_number' => 'nullable|required_if:payment_method,e_wallet|string', // Wajib diisi jika metode adalah e-wallet
            'bank_name' => 'nullable|required_if:payment_method,debit|string', // Nama bank wajib jika metode debit
            'e_wallet_name' => 'nullable|required_if:payment_method,e_wallet|string', // Nama e-wallet wajib jika metode e-wallet
        ]);

        $request->merge(['user_id' => auth()->id()]); // Menambahkan ID pengguna yang sedang login ke data yang akan disimpan

        PaymentMethod::create($request->all()); // Menyimpan data ke tabel PaymentMethod

        return redirect()->route('user.profile.paymentmethod.index')->with('success', 'Metode pembayaran berhasil ditambahkan.'); // Redirect dengan pesan sukses
    }

    // Fungsi untuk menampilkan form edit metode pembayaran
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('user.profile.paymentmethod.edit', compact('paymentMethod')); // Mengarahkan ke halaman edit dengan data metode pembayaran tertentu
    }

    // Fungsi untuk memperbarui data metode pembayaran di database
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
    
        $request->validate([
            'payment_method' => 'required|in:debit,e_wallet',
            'account_number' => 'nullable|required_if:payment_method,debit|string',
            'phone_number' => 'nullable|required_if:payment_method,e_wallet|string',
            'bank_name' => 'nullable|required_if:payment_method,debit|string',
            'e_wallet_name' => 'nullable|required_if:payment_method,e_wallet|string',
        ]);
    
        // Reset unused fields
        if ($request->payment_method === 'debit') {
            $paymentMethod->account_number = $request->account_number;
            $paymentMethod->bank_name = $request->bank_name;
            $paymentMethod->phone_number = null; // Hapus nomor telepon
            $paymentMethod->e_wallet_name = null; // Hapus nama e-wallet
        } elseif ($request->payment_method === 'e_wallet') {
            $paymentMethod->phone_number = $request->phone_number;
            $paymentMethod->e_wallet_name = $request->e_wallet_name;
            $paymentMethod->account_number = null; // Hapus nomor rekening
            $paymentMethod->bank_name = null; // Hapus nama bank
        }
    
        $paymentMethod->payment_method = $request->payment_method;
    
        $paymentMethod->save();
    
        return redirect()->route('user.profile.paymentmethod.index')
                         ->with('success', 'Metode pembayaran berhasil diperbarui.');
    }
    

    // Fungsi untuk menghapus data metode pembayaran dari database
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete(); // Menghapus data metode pembayaran dari database

        return redirect()->route('user.profile.paymentmethod.index')->with('success', 'Metode pembayaran berhasil dihapus.'); // Redirect dengan pesan sukses
    }
}
