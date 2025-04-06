@extends('m_user/template')
@section('title', 'Manajemen Pengguna')
@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2>Daftar Pengguna</h2>
        <a class="btn btn-success" href="{{ route('m_user.create') }}">+ Tambah User</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>User ID</th>
                    <th>Level ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($useri as $m_user)
                    <tr>
                        <td>{{ $m_user->user_id }}</td>
                        <td>{{ $m_user->level_id }}</td>
                        <td>{{ $m_user->username }}</td>
                        <td>{{ $m_user->nama }}</td>
                        <td>********</td> <!-- Hidden Password -->
                        <td class="text-center">
                            <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('m_user.show', $m_user->user_id) }}">Lihat</a>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('m_user.edit', $m_user->user_id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
