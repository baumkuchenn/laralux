@extends('layout.conquer2')
@section('isi')

<main>
    @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
    <a href="{{ route('hotel.create') }}" class="btn btn-xs btn-success mb-3">+ New Hotel</a>
    @endif
    <div class="gallery-container">
        @foreach ($hotels as $d)
        <a href="{{ route('hotel.show', $d->id) }}">
            <div class="card">
                <img src="{{ asset('images/thumbnail_hotel/' . $d->id . '.jpg') }}" alt="Hotel Logo">
                <div class="card-body">
                    <h5 class="card-title">{{ $d->nama }}</h5>
                    <p class="card-text">{{ $d->alamat }}</p>
                    <div class="stars">
                        @for ($i = 0; $i < $d->bintang; $i++)
                            <i class="fa fa-star"></i>
                            @endfor
                    </div>
                    <div>
                        <p>{{ $d->type->nama }}</p>
                    </div>
                    <div class="btn-group">
                        @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
                        <a href="{{ route('hotel.edit', $d->id) }}" class="btn">Edit</a>
                        <form method="POST" action="{{ route('hotel.destroy', $d->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->nama }} ? ');">
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</main>

<div class="modal fade" id="modalproduct" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Product</h4>
            </div>
            <div class="modal-body">
                <div id="showproduct">
                    nanti keisi
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-info" href="#modalCreate" data-toggle="modal">Tambah Transaksi (Pakai Modal)</a>
                <a class="btn btn-success" href="{{ url('/product/create') }}">Tambah Produk</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Transaksi Baru</h4>
            </div>
            <form method="POST" action="{{ url('product') }}">
                @csrf
                <div class="modal-body">
                    <label for="hotel">Nama Hotel</label>
                    <select name="hotel" id="hotel">
                        @foreach ($hotels as $h)
                        <option value="{{ $h->id }}">{{ $h->name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">
                        Pilih Hotel. </span>
                    <label for="roomType">Tipe Kamar</label>
                    <input type="text" class="form-control" placeholder="Masukkan Tipe Kamar" name="roomType">
                    <span class="help-block">
                        Masukkan tipe kamar. </span>
                    <label for="deskripsi">Deskripsi Kamar</label>
                    <input type="text" class="form-control" placeholder="Masukkan Deskripsi Kamar" name="deskripsi">
                    <span class="help-block">
                        Masukkan deskripsi kamar. </span>
                    <label for="jumlahIsi">Maksimal Orang</label>
                    <input type="text" class="form-control" placeholder="Masukkan Maksimal Orang Kamar di Kamar" name="jumlahIsi">
                    <span class="help-block">
                        Masukkan maksimal orang di kamar. </span>
                    <label for="harga">Harga per Malam</label>
                    <input type="text" class="form-control" placeholder="Masukkan Harga per Malam Kamar" name="harga">
                    <span class="help-block">
                        Masukkan Harga per Malam Kamar. </span>
                    <label for="jumlahAvail">Jumlah Kamar Kosong</label>
                    <input type="text" class="form-control" placeholder="Masukkan Jumlah Kamar Kosong" name="jumlahAvail">
                    <span class="help-block">
                        Masukkan Jumlah Kamar Kosong. </span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
@section('judul-halaman', 'Daftar Hotel')
@else
@section('judul-halaman', 'Hotel di Indonesia')
@endif
@section('title-halaman', 'Laralux.com | Hotel di Indonesia')
@section('javascript')
<script>
    $('.tombol-produk').click(function() {
        var idHotel = $(this).attr('data-id');
        var url = "{{ url('/show-product/') }}";
        // alert(url + "/" + idHotel);
        $.ajax({
            type: 'GET',
            url: url + "/" + idHotel,
            success: function(data) {
                $('#showproduct').html(data.msg)
            }
        });
    });
    // function showProduct(id) {
    //     $.ajax({
    //         type: 'GET',
    //         url: "/show-product/${id}",
    //         success: function(data) {
    //             $('#showproduct').html(data.msg)
    //         }
    //     });
    // }
</script>
@endsection