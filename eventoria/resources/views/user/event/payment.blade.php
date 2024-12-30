@extends('layouts.user')

@section('title', 'Pembayaran Event')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Pembayaran Event</h3>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5><strong>Event:</strong> {{ $event->event_name }}</h5>
                    <h6><strong>Harga:</strong> Rp {{ number_format($event->event_price, 0, ',', '.') }}</h6>
                    <h6><strong>Nama:</strong> {{ $name }}</h6>
                    <h6><strong>Email:</strong> {{ $email }}</h6>

                    <form action="{{ route('user.event.payment.store', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                @foreach ($payment_methods as $method)
                                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Lakukan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
