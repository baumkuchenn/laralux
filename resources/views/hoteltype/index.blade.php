@extends('layout.conquer2')
@section('isi')
    <div class="container">
        <a href="#disclaimer" data-toggle="modal">Disclaimer</a>
        <h2>Daftar Tipe Hotel</h2>
        <a href="{{ route('hoteltype.create') }}" class="btn btn-xs btn-success mb-3">+ New Type</a>
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
                            <a href="{{ route('hoteltype.edit', $r->id) }}" class="btn btn-xs btn-warning">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('hoteltype.destroy', $r->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="delete" class="btn btn-xs btn-danger"
                                    onclick="return confirm('Are you sure to delete {{ $r->id }} - {{ $r->nama }} ? ');">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
