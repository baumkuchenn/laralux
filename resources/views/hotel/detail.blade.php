@extends('layout.conquer2')
@section('isi')
<div style="display: flex; align-items: flex-start;">
    <img height="200px" src="{{ asset('images/thumbnail_hotel/'.$hotel->id.'.jpg') }}" />
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

<div style="margin-top: 20px;">
    @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
    <a href="{{ route('product.create', $hotel->id) }}" class="btn btn-xs btn-success mb-3" style="margin-bottom: 10px;">+ Tambah Kamar</a>
    @endif
    <table class="table">
        @foreach ($product as $item)
        <tr>
            <th>{{ $item->nama }} </th>
            <th>Fasilitas</th>
            <th>Harga/kamar/malam</th>
            <th></th>
        </tr>
        <tr>
            <td>
                <img height="200px" src="{{ asset('images/products/' . $item->id . '.jpg') }}" alt="Hotel Logo">
            </td>
            <td>
                <ul>
                    @foreach ($item->fasilitas as $fasilitas)
                    <li>{{ $fasilitas->nama }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $item->price }}</td>
            
            @if (auth()->check() && (auth()->user()->role == 'customer'))
            <td>
                <div class="action">
                    <a class="btn" href="{{route('addCart',$item->id)}}"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                    <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                </div>  
            </td>
            @endif
            
            <td>
                @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning">Ubah</a>
                <form method="POST" action="{{ route('product.destroy', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Hapus" class="btn btn-danger" onclick="return confirm('Apakah yakin mau menghapus kamar {{ $item->nama }}?')">
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
@section('judul-halaman', $hotel->nama)
@section('title-halaman', 'Laralux.com | Daftar Hotel')