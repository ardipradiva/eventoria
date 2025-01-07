@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Edit Metode Pembayaran</h1>
    <form action="{{ route('user.profile.paymentmethod.update', $paymentMethod->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="debit" {{ $paymentMethod->payment_method === 'debit' ? 'selected' : '' }}>Debit</option>
                <option value="e_wallet" {{ $paymentMethod->payment_method === 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
        </div>

        {{-- Input untuk Debit --}}
        <div id="debit_inputs" class="{{ $paymentMethod->payment_method === 'debit' ? '' : 'd-none' }}">
            <div class="mb-3">
                <label for="account_number" class="form-label">Nomor Rekening</label>
                <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $paymentMethod->account_number }}">
            </div>
            <div class="mb-3">
                <label for="bank_name" class="form-label">Nama Bank</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ $paymentMethod->bank_name }}">
            </div>
        </div>

        {{-- Input untuk E-Wallet --}}
        <div id="e_wallet_inputs" class="{{ $paymentMethod->payment_method === 'e_wallet' ? '' : 'd-none' }}">
            <div class="mb-3">
                <label for="phone_number" class="form-label">Nomor Telepon</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $paymentMethod->phone_number }}">
            </div>
            <div class="mb-3">
                <label for="e_wallet_name" class="form-label">Nama E-Wallet</label>
                <input type="text" name="e_wallet_name" id="e_wallet_name" class="form-control" value="{{ $paymentMethod->e_wallet_name }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodSelect = document.getElementById('payment_method');
        const debitInputs = document.getElementById('debit_inputs');
        const eWalletInputs = document.getElementById('e_wallet_inputs');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'debit') {
                debitInputs.classList.remove('d-none');
                eWalletInputs.classList.add('d-none');
            } else if (this.value === 'e_wallet') {
                eWalletInputs.classList.remove('d-none');
                debitInputs.classList.add('d-none');
            } else {
                debitInputs.classList.add('d-none');
                eWalletInputs.classList.add('d-none');
            }
        });
    });
</script>
@endsection
