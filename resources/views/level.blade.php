@extends('layouts.app')

@section('subtitle', 'Daftar Level')
@section('content_header_title', 'Manajemen Level')
@section('content_header_subtitle', 'Daftar Level Pengguna')

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data Level Pengguna</h3>
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kode Level</th>
                        <th>Nama Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->level_id }}</td>
                            <td>{{ $d->level_kode }}</td>
                            <td>{{ $d->level_nama }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
