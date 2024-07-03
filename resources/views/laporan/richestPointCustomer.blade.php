@extends('layout.conquer2')
@section('isi')

<div class="container mt-5">
    <h3 class="mb-4 text-center text-primary"><i class="fa fa-star"></i> Customer dengan Poin Terbanyak</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">ID Customer</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">Email</th>
                    <th scope="col">Sign Up Pertama Kali</th>
                    <th scope="col">Poin yang Dimiliki</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center font-weight-bold">{{$topUser->id}}</td>
                    <td>{{$topUser->name}}</td>
                    <td>{{$topUser->email}}</td>
                    <td>{{$topUser->created_at}}</td>
                    <td class="text-success font-weight-bold">{{$topUser->total_poin}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('judul-halaman')
<i class="fa fa-paperclip"></i> Customer dengan Poin Terbanyak
@endsection

@section('title-halaman', 'Laralux.com | Customer dengan Poin Terbanyak')