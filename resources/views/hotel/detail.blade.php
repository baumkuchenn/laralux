@extends('layout.conquer2')
@section('isi')
<div>
    <h2><b>{{$hotel->nama}}</b></h2>
    <p><i class="fa fa-map-marker"></i> {{$hotel->alamat}}</p>
</div>
<div>

</div>
<div>
    <a href="{{ route('product.create') }}" class="btn btn-xs btn-success mb-3">+ Tambah Kamar</a>
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
                <a href="{{ url('product/'.$item->id.'/edit') }}" class="btn btn-warning">Ubah</a>
                <form method="POST" action="{{ url('product/'.$item->id) }}">
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