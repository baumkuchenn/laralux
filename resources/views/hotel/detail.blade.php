@extends('layout.conquer2')
@section('isi')
<div style="display: flex; align-items: flex-start;">
    <img height="200px" src="{{ asset('images/thumbnail_hotel/'.$hotel->id.'.jpg') }}" />
    <div style="flex: 1; margin-left: 20px;">
        <h2><b>Grand Paradise Resort</b></h2>
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
    <a href="{{ route('product.create', $hotel->id) }}" class="btn btn-xs btn-success mb-3" style="margin-bottom: 10px;">+ Tambah Kamar</a>
    <table class="table">
        <tr>
            <th>Tipe Kamar</th>
            <th>Harga</th>
        </tr>
        @foreach ($product as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->price }}</td>
            <td>
                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning">Ubah</a>
                <form method="POST" action="{{ route('product.destroy', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Hapus" class="btn btn-danger" onclick="return confirm('Apakah yakin mau menghapus kamar {{ $item->nama }}?')">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
@section('judul-halaman', $hotel->nama)
@section('title-halaman', 'Laralux.com | Daftar Hotel')