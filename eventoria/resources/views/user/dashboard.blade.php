@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Mau konser apa hari ini, {{ auth()->user()->name }}?</h1>

        {{-- Icon Profile, Cart, and History --}}
        <div class="d-flex align-items-center">            
            {{-- Cart Icon Image --}}
            <a href="{{ route('user.cart') }}" class="btn btn-secondary me-3">
                <img src="{{ asset('storage/images/cart.png') }}" alt="Cart" style="width: 40px; height: 40px;">
            </a>

            {{-- History Icon Image --}}
            <a href="{{ route('user.history') }}" class="btn btn-secondary me-3">
                <img src="{{ asset('storage/images/history.png') }}" alt="History" style="width: 40px; height: 40px;">
            </a>
            
            {{-- Profile Picture --}}
            <a href="{{ route('user.profile') }}" class="me-1">
                <img src="{{ asset('storage/images/user.png') }}" alt="User" style="width: 80px; height: 80px;">
            </a>
        </div>
    </div>

    {{-- Carousel Event --}}
    <div id="eventCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($events as $event)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/'.$event->event_image) }}" class="d-block w-100" alt="{{ $event->event_name }}" style="height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $event->event_name }}</h5>
                        <p>{{ $event->event_location }} - {{ $event->event_date->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- List of All Events (with Cards) --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Semua Event
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/'.$event->event_image) }}" class="card-img-top" alt="{{ $event->event_name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->event_name }}</h5>
                                <p class="card-text">{{ $event->event_location }} - {{ $event->event_date->format('d M Y') }}</p>
                                <p class="card-text"><strong>Harga: </strong>Rp {{ number_format($event->event_price, 0, ',', '.') }}</p>
                                <a href="{{ route('user.event.show', $event->id) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="text-center mt-4">
        <p>Eventoria</p>
    </footer>
</div>
@endsection
