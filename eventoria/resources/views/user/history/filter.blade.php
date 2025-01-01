@extends('layouts.user')

@section('title', 'Cari Tiket')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Cari Tiket Anda</h3>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="{{ route('user.history.filter') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cari Tiket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
