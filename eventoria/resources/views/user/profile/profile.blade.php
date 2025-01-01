@extends('layouts.user')

@section('content')
<div class="container mt-4">
    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Profil Anda</h1>
    </div>

    {{-- Detail User --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Detail User
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ auth()->user()->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ auth()->user()->username }}</td>
                </tr>
                <tr>
                    <th>Tanggal Bergabung</th>
                    <td>{{ auth()->user()->created_at->format('d M Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Tombol Payment Method --}}
    <div class="text-center">
        <a href="{{ route('user.profile.paymentmethod.index') }}" class="btn btn-primary">Kelola Metode Pembayaran</a>
    </div>
</div>
@endsection
