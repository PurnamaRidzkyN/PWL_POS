@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif 
            
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama kategori</th>
                        <th>Kode kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataKategori = $('#table_kategori').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    "url": "{{ url('kategori/list') }}", // URL tetap 'kategori/list'
                    "type": "POST"
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "kategori_nama", orderable: true, searchable: true },
                    { data: "kategori_kode", oarderable: true, searchable: true },
                    { data: "aksi", orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
