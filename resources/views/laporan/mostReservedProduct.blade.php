@extends('layout.conquer2')
@section('isi')

<div class="container mt-5">
    <h3 class="mb-4 text-center text-primary"><i class="fa fa-star"></i> Produk yang paling sering direservasi</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Product ID</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Direservasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $p)
                <tr>

                    <td class="text-center font-weight-bold">{{$p->id}}</td>
                    <td>{{$p->nama}}</td>
                    <td>{{$p->jumlah_direservasi}}</td>                    

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('judul-halaman')
<i class="fa fa-paperclip"></i> Customer dengan Poin Terbanyak
@endsection

@section('title-halaman', 'Laralux.com | Customer dengan Poin Terbanyak')