@extends('layouts.user')

@section('title', 'Tiket Anda')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Daftar Tiket Anda</h3>
    @if ($tickets->isEmpty())
        <p class="text-center">Tidak ada tiket ditemukan untuk nama dan email yang Anda masukkan.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Event</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->event_name }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>
                        <a href="{{ route('user.history.show', $ticket->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
