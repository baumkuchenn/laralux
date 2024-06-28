@extends('layout.conquer2')
@section('isi')
@if (@session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif


<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Masukkan Kamar Baru {{$hotel->nama}}
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="" class="reload"></a>
            <a href="" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <label for="producttype_id">Tipe Kamar</label>
                <select class="form-control" id="producttype_id" name="product_type">
                    @foreach ($types as $t)
                    <option value="{{ $t->id }}">{{ $t->nama }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Pilih tipe kamar dari list berikut.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputType">Nama Kamar</label>
                <input type="text" class="form-control" id="exampleInputType" name="product_name" aria-describedby="nameHelp" placeholder="Masukkan Nama Kamar...">
                <small id="nameHelp" class="form-text text-muted">Masukkan nama kamar disini.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputType">Harga Kamar</label>
                <input type="text" class="form-control" id="exampleInputType" name="product_price" aria-describedby="nameHelp" placeholder="Masukkan Harga Kamar...">
                <small id="nameHelp" class="form-text text-muted">Masukkan harga kamar disini.</small>
            </div>

            <div class="form-group">
                <label for="gambar_kamar">Gambar Kamar</label>
                <input type="file" class="form-control" id="gambar_kamar" name="gambar_kamar">
                <small id="thumbnailHelp" class="form-text text-muted">Upload thumbnail hotel disini.</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
@section('judul-halaman', 'Tambah Kamar Hotel')