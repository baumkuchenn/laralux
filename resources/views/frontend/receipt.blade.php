@extends('layout.conquer2')
@section('isi')
@if(session('status'))
<div class="alert alert-success" style="font-weight: bold;">
    {{ session('status') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger" style="font-weight: bold;">
    {{ session('error') }}
</div>
@endif



@endsection
@section('judul-halaman')
<i class="fa fa-file-text-o fa-5x"></i> Receipt
@endsection

@section('title-halaman', 'Laralux.com | Daftar Hotel')