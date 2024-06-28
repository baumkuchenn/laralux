@extends('layout.conquer2')
@section('isi')
@if (@session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif


<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Edit Tipe Kamar
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="" class="reload"></a>
            <a href="" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('producttype.update', $data->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputType">Nama Tipe Kamar</label>
                <input type="text" class="form-control" id="exampleInputType" name="type_name" aria-describedby="nameHelp" placeholder="Masukkan Nama Tipe Kamar..." value="{{ $data->nama }}">
                <small id="nameHelp" class="form-text text-muted">Masukkan nama tipe kamar disini.</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
@section('judul-halaman', 'Edit Tipe Kamar')
@section('navigasi')
<li>
    <i class="fa fa-home"></i>
    <a href="{{ route('hotel.index') }}">Home</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <a href="{{ route('producttype.index') }}">Daftar Tipe Kamar</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <b>Edit Tipe Kamar {{ $data->nama }}</b>
</li>
@endsection