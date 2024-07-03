@extends('layout.conquer2')
@section('isi')
@if (@session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif


<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Masukkan Customer Sebagai Member
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="" class="reload"></a>
            <a href="" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">Nama Customer</label>
                <select class="form-control" id="user_id" name="user">
                    @foreach ($user as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Pilih customer dari list berikut.</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
@section('judul-halaman', 'Tambah Kamar Hotel')
@section('navigasi')
<li>
    <i class="fa fa-home"></i>
    <a href="{{ route('hotel.index') }}">Home</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <a href="{{ route('customer.index') }}">Daftar Membership</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <b>Tambah Membership</b>
</li>
@endsection