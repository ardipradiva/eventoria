@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Metode Pembayaran</h1>
    <a href="{{ route('user.profile.paymentmethod.create') }}" class="btn btn-primary mb-3">Tambah Metode Pembayaran</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Metode</th>
                <th>Nomor Rekening</th>
                <th>Nomor Telepon</th>
                <th>Nama Bank</th>
                <th>Nama E-Wallet</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentMethods->where('user_id', auth()->id()) as $method)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $method->payment_method }}</td>
                    <td>{{ $method->account_number }}</td>
                    <td>{{ $method->phone_number }}</td>
                    <td>{{ $method->bank_name }}</td>
                    <td>{{ $method->e_wallet_name }}</td>
                    <td>
                        <a href="{{ route('user.profile.paymentmethod.edit', $method->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('user.profile.paymentmethod.destroy', $method->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Hapus metode pembayaran ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
