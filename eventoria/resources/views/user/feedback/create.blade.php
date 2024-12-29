@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h1 class="h3">Tambah Feedback</h1>

    <form action="{{ route('user.feedback.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
        <a href="{{ route('user.feedback.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection