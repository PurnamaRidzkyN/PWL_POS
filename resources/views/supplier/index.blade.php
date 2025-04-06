@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Tambah Supplier</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-1 control-label col-form-label">Filter :</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="filter_nama" placeholder="Nama Supplier">
                                    <small class="form-text text-muted">Cari berdasarkan nama</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
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
            var dataSupplier = $('#table_supplier').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('supplier/list') }}",
                    type: "POST",
                    data: function(d) {
                        d.nama_supplier = $('#filter_nama').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "kode_supplier",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama_supplier",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "telepon",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "alamat",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#filter_nama').on('keyup change', function() {
                dataSupplier.ajax.reload();
            });
        });
    </script>
@endpush
