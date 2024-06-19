@extends("layout.conquer2")
@section('isi')

<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <!-- <th>Logo</th> -->
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Bintang</th>
            <th>Tipe</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hotels as $hotel)
        <tr>
            <td>{{ $hotel->nama }}</td>
            <!-- <td>
                <img height='100px' src="{{ asset('images/logo/'.$hotel->id.'.jpg')}}" /><br>
                <a href="{{ url('hotel/uploadLogo/'.$hotel->id) }}">
                    <button class='btn btn-xs btn-default'>upload</button>
                </a>
                <form style="display: inline" method="POST" action="{{url('hotel/delPhoto')}}">
                    @csrf
                    <input type="hidden" value="{{'images/logo/'.$hotel->id.'.jpg'}}" name='filepath' />
                    <input type="submit" value="delete" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure ? ');">
                </form>

            </td> -->
            <td>{{ $hotel->alamat }}</td>
            <td>{{ $hotel->no_telpon }}</td>
            <td>{{ $hotel->email }}</td>
            <td>{{ $hotel->bintang }}</td>
            <td>{{ $hotel->type->nama }}</td>
            <td>
                <a class="btn btn-info" href="#detail_{{$hotel->id}}" data-toggle="modal">Detail</a>

                <a class="btn btn-success tombol-produk" href="#modalproduct" data-toggle="modal" data-id="{{$hotel->id}}">Product</a>

                <div class="modal fade" id="detail_{{$hotel->id}}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{$hotel->nama}}</h4>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('images/hotels/'.$hotel->image.'.jpg') }}" height="200px" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <!-- @if($hotel->products)
        @foreach($hotel->products as $product)
        <tr>
            <td colspan="3">{{ $product->room_type }}</td>
            <td>{{ $product->base_price_per_night }}</td>
        </tr>
        @endforeach
        @endif -->
        @endforeach
    </tbody>
</table>

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
                        @foreach($hotels as $h)
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
@section('judul-halaman', 'Daftar Hotel')
@section('title-halaman', 'Laralux.com | Daftar Hotel')
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