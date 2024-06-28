@extends('layout.conquer2')
@section('isi')
<style>
    .thumbnail-image {
        height: 100px;
        width: auto;
        padding: 5px;
    }

    .hotel-info img {
        height: 100px;
        width: auto;
    }

    .stars .fa-star {
        color: #FFD700;
        /* Warna emas untuk bintang */
    }

    .hotel-info h4 {
        font-size: 1em;
        margin: 5px 0;
    }

    .btn-success.mb-3 {
        margin-bottom: 10px;
    }

    .table td img {
        height: 100px;
        width: auto;
    }
</style>

<div style="display: flex; align-items: flex-start;">
    <img class="img-thumbnail" src="{{ asset('images/thumbnail_hotel/'.$hotel->id.'.jpg') }}" />
    <div style="flex: 1; margin-left: 20px;">
        <h2><b>{{ $hotel->nama }}</b></h2>
        <div class="stars">
            @for ($i = 0; $i < $hotel->bintang; $i++)
                <i class="fa fa-star"></i>
                @endfor
        </div>
        <h4><i class="fa fa-map-marker" style="font-size: 1em;"></i> {{$hotel->alamat}}</h4>
        <h4><i class="fa fa-envelope" style="font-size: 1em;"></i> {{$hotel->email}}</h4>
        <h4><i class="fa fa-phone" style="font-size: 1em;"></i> {{$hotel->no_telpon}}</h4>
    </div>
</div>

<div>
    @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
    <a href="{{ route('product.create', $hotel->id) }}" class="btn btn-success mb-3">+ Tambah Kamar</a>
    @endif
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nama Kamar</th>
                <th>Fasilitas</th>
                <th>Harga/kamar/malam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $item)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img class="img-thumbnail thumbnail-image" src="{{ asset('images/products/' . $item->id . '.jpg') }}" alt="Hotel Logo">
                        <p class="ml-2 font-weight-bold">{{ $item->nama }}</p>
                    </div>
                </td>
                <td>
                    <ul>
                        @foreach ($item->fasilitas as $fasilitas)
                        <li>{{ $fasilitas->nama }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ 'IDR '. number_format($item->price, 0, ',', '.') }}</td>

                @if (!auth()->check() || (auth()->user()->role == 'customer'))
                <td>
                    <a class="btn btn-primary" href="{{route('addCart',$item->id)}}">
                        <i class="fa fa-shopping-cart"></i> Add to Cart
                    </a>
                </td>
                @endif

                @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
                <td>
                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning mb-2">Ubah</a>
                    <form method="POST" action="{{ route('product.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Hapus" class="btn btn-danger" onclick="return confirm('Apakah yakin mau menghapus kamar {{ $item->nama }}?')">
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('judul-halaman', $hotel->nama)
@section('title-halaman', 'Laralux.com | Daftar Hotel')
@section('navigasi')
<li>
    <i class="fa fa-home"></i>
    <a href="{{ route('hotel.index') }}">Home</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <b>{{ $hotel->nama }}</b>
</li>
@endsection