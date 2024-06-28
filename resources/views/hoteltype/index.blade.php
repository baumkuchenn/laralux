@extends('layout.conquer2')
@section('isi')
<a href="{{ route('hoteltype.create') }}" class="btn btn-xs btn-success mb-3">+ New Type</a>
<div style="margin-top: 20px;">
    <table class="table">
        <thead>
            <tr>
                <th>Nama Tipe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>
                    <a href="{{ route('hoteltype.edit', $r->id) }}" class="btn btn-xs btn-warning">Ubah</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('hoteltype.destroy', $r->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Hapus" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus tipe hotel {{ $r->nama }} ? ');">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('judul-halaman', 'Daftar Tipe Hotel')
@section('navigasi')
<li>
    <i class="fa fa-home"></i>
    <a href="{{ route('hotel.index') }}">Home</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <b>Daftar Tipe Hotel</b>
</li>
@endsection