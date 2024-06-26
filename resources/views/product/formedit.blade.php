@extends('layout.conquer2')
@section('isi')
@if (@session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif


<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Edit Kamar {{$hotel->nama}}
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="" class="reload"></a>
            <a href="" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('product.update', $product->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <label for="producttype_id">Tipe Kamar</label>
                <select class="form-control" id="producttype_id" name="product_type">
                    @foreach ($types as $t)
                    <option value="{{ $t->id }}" {{ $t->id == $product->producttype_id ? 'selected' : '' }}>{{ $t->nama }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Pilih tipe kamar dari list berikut.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputType">Nama Kamar</label>
                <input type="text" class="form-control" id="exampleInputType" name="product_name" aria-describedby="nameHelp" placeholder="Masukkan Nama Kamar..." value="{{ $product->nama }}">
                <small id="nameHelp" class="form-text text-muted">Masukkan nama kamar disini.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputType">Harga Kamar</label>
                <input type="text" class="form-control" id="exampleInputType" name="product_price" aria-describedby="nameHelp" placeholder="Masukkan Harga Kamar..." value="{{ $product->price }}">
                <small id="nameHelp" class="form-text text-muted">Masukkan harga kamar disini.</small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection