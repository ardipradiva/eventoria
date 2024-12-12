@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Dashboard</h1>
        <a href="{{ route('admin.event.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Event
        </a>
    </div>

    {{-- Info Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Events</h5>
                    <p class="card-text display-6">{{ $totalEvents }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Users Terdaftar</h5>
                    <p class="card-text display-6">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Pendaftaran Hari Ini</h5>
                    <p class="card-text display-6">{{ $registrationsToday }}</p>
                </div>
            </div>
        </div>
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
