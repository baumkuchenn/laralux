@extends('layout.conquer2')
@section('isi')
<a href="{{ route('producttype.create') }}" class="btn btn-xs btn-success mb-3">+ Tambah Tipe Kamar</a>
<div style="margin-top: 20px;">
    <table class="table">
        <thead>
            <tr>
                <th>Nama Tipe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($type as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>
                    <a href="{{ route('producttype.edit', $r->id) }}" class="btn btn-xs btn-warning">Ubah</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('producttype.destroy', $r->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Hapus" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus tipe kamar {{ $r->nama }} ? ');">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('judul-halaman', 'Daftar Tipe Kamar')