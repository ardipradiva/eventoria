@extends('layouts.user')

@section('title', 'Detail Tiket')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Detail Tiket</h3>
    <div class="card shadow-lg">
        <div class="card-body">
            <h5><strong>Nama Event:</strong> {{ $ticket->event_name }}</h5>
            <h6><strong>Nama:</strong> {{ $ticket->name }}</h6>
            <h6><strong>Email:</strong> {{ $ticket->email }}</h6>
            <div class="mt-3">
                <a href="{{ route('user.history.edit', $ticket->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('user.history.print', $ticket->id) }}" class="btn btn-success">Print Tiket</a>
                <form action="{{ route('user.history.destroy', $ticket->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Batalkan tiket ini?')">Batalkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
