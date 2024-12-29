@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Edit Event</h3>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="event_name" class="form-label">Nama Event</label>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}" required>
                            @error('event_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_description" class="form-label">Deskripsi Event</label>
                            <textarea class="form-control @error('event_description') is-invalid @enderror" id="event_description" name="event_description" rows="4" required>{{ old('event_description', $event->event_description) }}</textarea>
                            @error('event_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_location" class="form-label">Lokasi Event</label>
                            <input type="text" class="form-control @error('event_location') is-invalid @enderror" id="event_location" name="event_location" value="{{ old('event_location', $event->event_location) }}" required>
                            @error('event_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_date" class="form-label">Tanggal Event</label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_time" class="form-label">Jam Event</label>
                            <input type="time" class="form-control @error('event_time') is-invalid @enderror" id="event_time" name="event_time" value="{{ old('event_time', $event->event_date->format('H:i')) }}" required>
                            @error('event_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_image" class="form-label">Gambar Event</label>
                            <input type="file" class="form-control @error('event_image') is-invalid @enderror" id="event_image" name="event_image" accept="image/*">
                            @error('event_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($event->event_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $event->event_image) }}" alt="Event Image" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="event_price" class="form-label">Harga Event</label>
                            <input type="number" class="form-control @error('event_price') is-invalid @enderror" id="event_price" name="event_price" value="{{ old('event_price', $event->event_price) }}" required>
                            @error('event_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_provider" class="form-label">Penyedia Event</label>
                            <input type="text" class="form-control @error('event_provider') is-invalid @enderror" id="event_provider" name="event_provider" value="{{ old('event_provider', $event->event_provider) }}" required>
                            @error('event_provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Perbarui Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
