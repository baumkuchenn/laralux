@extends('layout.conquer2')
@section('isi')
<a href="{{ route('fasilitas.create') }}" class="btn btn-xs btn-success mb-3">+ Tambah Fasilitas</a>
<div style="margin-top: 20px;">
    <table class="table">
        <thead>
            <tr>
                <th>Nama Fasilitas</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fasilitas as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->deskripsi }}</td>
                <td>
                    <a href="{{ route('fasilitas.edit', $r->id) }}" class="btn btn-xs btn-warning">Ubah</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('fasilitas.destroy', $r->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Hapus" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus fasilitas {{ $r->nama }} ? ');">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('judul-halaman', 'Daftar Fasilitas')
@section('navigasi')
<li>
    <i class="fa fa-home"></i>
    <a href="{{ route('hotel.index') }}">Home</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <b>Daftar Fasilitas</b>
</li>
@endsection