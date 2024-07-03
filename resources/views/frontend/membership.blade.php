@extends('layout.conquer2')

@section('isi')
@if(session('status'))
<div class="alert alert-success" style="font-weight: bold;">
    {{ session('status') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger" style="font-weight: bold;">
    {{ session('error') }}
</div>
@endif

<div class="container mt-3">
    <div class="row">
        @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h2 class="card-title flex-grow-1">Daftar customer anda:</h2>
        </div>
        <div class="table-responsive overflow-auto">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%; text-align: center;">No.</th>
                        <th>Nama Customer</th>
                        <th>Email</th>
                        <th>Tanggal Sign Up</th>
                        <th>Poin yang dimiliki</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allCust as $index => $a)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td class="text-nowrap">{{ $a->name }}</td>
                        <td class="text-nowrap">{{ $a->email }}</td>
                        <td class="text-nowrap">{{ $a->created_at }}</td>
                        <td class="text-nowrap">{{ $a->total_poin }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if (auth()->check() && (auth()->user()->role == 'customer'))
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h1 style="font-size: 2.5rem; color: #007bff; font-weight: bold; text-transform: uppercase; text-align: center; margin-bottom: 20px; background-color: yellow;">
                    Poin Anda Saat Ini: {{$points}}
                </h1>
                <h2 class="card-title flex-grow-1">Detail Poin yang didapat:</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%; text-align: center;"></th>
                            <th>Didapat dari Transaksi</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($membership as $index => $m)
                        @if ($m->points)
                        <tr>
                            <td style="text-align: center; background-color: lightgreen;">
                                <i class="fa fa-check-square-o"></i>
                            </td>
                            <td class="text-nowrap">{{ \Carbon\Carbon::parse($m->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="text-nowrap">{{ $m->points }}</td>
                        </tr>
                        @endif
                        @endforeach
                        @if ($membership->where('points', '>', 0)->isEmpty())
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada poin yang didapat.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Tabel Poin yang Ditukarkan -->
            <h2 class="card-title flex-grow-1 mt-4">Detail Poin yang Ditukarkan:</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%; text-align: center;"></th>
                            <th>Ditukarkan pada Transaksi</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($membership as $index => $m)
                        @if ($m->redeempoints)
                        <tr>
                            <td style="text-align: center; background-color: red;">
                                <i class="fa fa-check-square-o"></i>
                            </td>
                            <td class="text-nowrap">{{ \Carbon\Carbon::parse($m->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="text-nowrap">{{ $m->redeempoints }}</td>
                        </tr>
                        @endif
                        @endforeach
                        @if ($membership->where('redeempoints', '>', 0)->isEmpty())
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada poin yang ditukarkan.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

@section('judul-halaman')
<i class="fa fa-file-text-o"></i> Membership
@endsection

@section('title-halaman', 'Laralux.com | Membership')