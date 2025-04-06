@extends('layouts.app')

@section('subtitle', 'Tambah User')
@section('content_header_title', 'Manajemen User')
@section('content_header_subtitle', 'Tambah Pengguna')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Tambah User</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="username" required>
                </div>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level_id" required>
                    @foreach($levels as $level)
                        <option value="{{ $level->level_id }}">{{ $level->level_nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
