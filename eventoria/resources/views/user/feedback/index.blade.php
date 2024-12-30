@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h1 class="h3">Feedback</h1>

    <a href="{{ route('user.feedback.create') }}" class="btn btn-primary mb-3">Tambah Feedback</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedback as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->message }}</td>
                    <td>
                        <a href="{{ route('user.feedback.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('user.feedback.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Hapus feedback ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection