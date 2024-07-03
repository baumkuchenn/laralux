@extends('layout.conquer2')
@section('isi')

<div class="mt-5">
    <h3 class="mb-4 text-center text-primary"><i class="fa fa-star"></i> Customer dengan Total pembelian terbanyak</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">ID Customer</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">Total keseluruhan reservasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>

                    <td class="text-center font-weight-bold">{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td class="text-success font-weight-bold"> IDR {{number_format($u->total_seluruh_pembelian,0, ',', '.')}}</td>

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