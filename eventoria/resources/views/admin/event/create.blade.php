@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Buat Event Baru</h3>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="event_name" class="form-label">Nama Event</label>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" value="{{ old('event_name') }}" required>
                            @error('event_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_description" class="form-label">Deskripsi Event</label>
                            <textarea class="form-control @error('event_description') is-invalid @enderror" id="event_description" name="event_description" rows="4" required>{{ old('event_description') }}</textarea>
                            @error('event_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_location" class="form-label">Lokasi Event</label>
                            <input type="text" class="form-control @error('event_location') is-invalid @enderror" id="event_location" name="event_location" value="{{ old('event_location') }}" required>
                            @error('event_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_date" class="form-label">Tanggal Event</label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input untuk memilih jam -->
                        <div class="mb-3">
                            <label for="event_time" class="form-label">Jam Event</label>
                            <input type="time" class="form-control @error('event_time') is-invalid @enderror" id="event_time" name="event_time" value="{{ old('event_time') }}" required>
                            @error('event_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_image" class="form-label">Gambar Event</label>
                            <input type="file" class="form-control @error('event_image') is-invalid @enderror" id="event_image" name="event_image" accept="image/*" required>
                            @error('event_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_price" class="form-label">Harga Event</label>
                            <input type="number" class="form-control @error('event_price') is-invalid @enderror" id="event_price" name="event_price" value="{{ old('event_price') }}" required>
                            @error('event_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_provider" class="form-label">Penyedia Event</label>
                            <input type="text" class="form-control @error('event_provider') is-invalid @enderror" id="event_provider" name="event_provider" value="{{ old('event_provider') }}" required>
                            @error('event_provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Buat Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
