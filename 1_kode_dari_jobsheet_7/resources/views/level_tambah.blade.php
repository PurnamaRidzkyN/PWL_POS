@extends('layouts.app')

@section('subtitle', 'Tambah Level')
@section('content_header_title', 'Manajemen Level')
@section('content_header_subtitle', 'Tambah Level Pengguna')

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Level</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('level.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" class="form-control" name="level_kode" placeholder="Kode Level" required>
            </div>
            <div class="form-group">
                <label>Nama Level</label>
                <input type="text" class="form-control" name="level_nama" placeholder="Nama Level" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
