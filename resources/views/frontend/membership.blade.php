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
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h1 style="font-size: 2.5rem; color: #007bff; font-weight: bold; text-transform: uppercase; text-align: center; margin-bottom: 20px;">
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Detail transaksi akan dimuat di sini oleh AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('judul-halaman')
<i class="fa fa-file-text-o"></i> Membership
@endsection

@section('title-halaman', 'Laralux.com | Membership')