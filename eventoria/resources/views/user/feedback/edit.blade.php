@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h1 class="h3">Edit Feedback</h1>

    <form action="{{ route('user.feedback.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $feedback->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $feedback->email }}" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea name="message" id="message" class="form-control" rows="5" required>{{ $feedback->message }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('user.feedback.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection