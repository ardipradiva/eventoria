@extends('layouts.admin')

@section('title', 'Detail Event')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Detail Event</h3>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->event_name }}</h5>
                    <p class="card-text">{{ $event->event_description }}</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Lokasi:</strong> {{ $event->event_location }}</h6>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Jam:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }}</h6>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Harga:</strong> Rp {{ number_format($event->event_price, 0, ',', '.') }}</h6>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6><strong>Penyedia:</strong> {{ $event->event_provider }}</h6>
                        </div>
                    </div>

                    @if ($event->event_image)
                        <div class="mt-3">
                            <h6><strong>Gambar Event:</strong></h6>
                            <img src="{{ asset('storage/' . $event->event_image) }}" alt="Event Image" class="img-fluid">
                        </div>
                    @endif
                    
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
                        </a>

                        <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit Event
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
