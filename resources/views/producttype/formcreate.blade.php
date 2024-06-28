@extends('layout.conquer2')
@section('isi')
@if (@session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif


<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Masukkan Tipe Kamar
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="" class="reload"></a>
            <a href="" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('producttype.store') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputType">Nama Tipe Kamar</label>
                <input type="text" class="form-control" id="exampleInputType" name="type_name" aria-describedby="nameHelp" placeholder="Masukkan Nama Tipe Hotel...">
                <small id="nameHelp" class="form-text text-muted">Masukkan nama tipe kamar disini.</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
@section('judul-halaman', 'Tambah Tipe Kamar')