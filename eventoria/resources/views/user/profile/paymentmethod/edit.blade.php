@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Edit Metode Pembayaran</h1>
    <form action="{{ route('user.profile.paymentmethod.update', $paymentMethod->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="payment_method" class="form-label">Jenis Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="debit" {{ $paymentMethod->payment_method === 'debit' ? 'selected' : '' }}>Debit</option>
                <option value="e_wallet" {{ $paymentMethod->payment_method === 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
        </div>

        <div class="mb-3" id="debitFields" style="display: {{ $paymentMethod->payment_method === 'debit' ? 'block' : 'none' }};">
            <label for="account_number" class="form-label">Nomor Rekening</label>
            <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $paymentMethod->account_number }}">

            <label for="bank_name" class="form-label">Nama Bank</label>
            <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ $paymentMethod->bank_name }}">
        </div>

        <div class="mb-3" id="eWalletFields" style="display: {{ $paymentMethod->payment_method === 'e_wallet' ? 'block' : 'none' }};">
            <label for="phone_number" class="form-label">Nomor Telepon</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $paymentMethod->phone_number }}">

            <label for="e_wallet_name" class="form-label">Nama E-Wallet</label>
            <input type="text" name="e_wallet_name" id="e_wallet_name" class="form-control" value="{{ $paymentMethod->e_wallet_name }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('user.profile.paymentmethod.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function () {
        const debitFields = document.getElementById('debitFields');
        const eWalletFields = document.getElementById('eWalletFields');

        if (this.value === 'debit') {
            debitFields.style.display = 'block';
            eWalletFields.style.display = 'none';
        } else if (this.value === 'e_wallet') {
            debitFields.style.display = 'none';
            eWalletFields.style.display = 'block';
        }
    });
</script>
@endsection
