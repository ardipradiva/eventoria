@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Event</h1>
        <a href="{{ route('admin.event.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Event
        </a>
    </div>

    {{-- Carousel Event --}}
    <div id="eventCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($events as $event)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/'.$event->event_image) }}" class="d-block w-100" alt="{{ $event->event_name }}" style="height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block ">
                        <h5>{{ $event->event_name }}</h5>
                        <p>{{ $event->event_location }} - {{ $event->event_date }}</p>
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

    {{-- Tabel Events --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            Daftar Event Terbaru
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Event</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ $event->event_location }}</td>
                            <td>{{ $event->event_date }}</td>
                            <td>Rp {{ number_format($event->event_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.event.show', $event->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada event yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
