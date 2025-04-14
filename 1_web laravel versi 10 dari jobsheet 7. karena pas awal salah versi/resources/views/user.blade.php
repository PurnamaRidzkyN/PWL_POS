@extends('layouts.app')

@section('subtitle', 'Daftar User')
@section('content_header_title', 'Manajemen User')
@section('content_header_subtitle', 'Daftar Pengguna')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data User</h3>
            <a href="{{ route('user.create') }}" class="btn btn-success float-right">Tambah User</a>
        </div>
        <div class="card-body">
            @if ($data->isEmpty())
                <p class="alert alert-warning">Tidak ada data user.</p>
            @else
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>ID Level</th>
                            <th>Kode Level</th>
                            <th>Nama Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->user_id }}</td>
                                <td>{{ $d->username }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->level_id }}</td>
                                <td>{{ $d->level->level_kode }}</td>
                                <td>{{ $d->level->level_nama }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $d->user_id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    <form action="{{ route('user.destroy', $d->user_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
