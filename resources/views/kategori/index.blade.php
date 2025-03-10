@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">Add Kategori</a>
        </div>
    <div class="card-body">
        {!! $dataTable->table() !!}

    </div>
    </div>
</div>
@endsection

{{-- Push extra scripts --}}
@push('scripts')
{{ $dataTable->scripts() }}
@endpush
