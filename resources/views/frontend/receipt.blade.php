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

<div class="row mt-3">
    @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
    @if (auth()->user()->role == 'owner')
    <a href="{{ route('transaction.create') }}" class="btn btn-xs btn-success mb-3" style="margin-bottom: 20px;">+ New Transaksi</a>
    @endif

    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h2 class="card-title flex-grow-1">Daftar semua transaksi dari customer anda:</h2>
        </div>
        <div class="table-responsive overflow-auto">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%; text-align: center;">No.</th>
                        <th>Customer</th>
                        <th>Tanggal Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allTransactions as $index => $a)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td class="text-nowrap">{{ $a->name }}</td>
                        <td class="text-nowrap">{{ $a->created_at }}</td>
                        <td>
                            <a class="btn btn-info d-md-none" href="#detailModal" data-toggle="modal" onclick="getDetailData({{ $a->id }});">Lihat Rincian</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if (auth()->check() && (auth()->user()->role == 'customer'))
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h2 class="card-title flex-grow-1">Transaksi anda:</h2>
        </div>
        <div class="table-responsive overflow-auto">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%; text-align: center;">No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $index => $transaction)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td class="text-nowrap">{{ $transaction->created_at }}</td>
                        <td>
                            <a class="btn btn-info d-md-none" href="#detailModal" data-toggle="modal" onclick="getDetailData({{ $transaction->id }});">Lihat Rincian</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>


<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel" style="text-align: center;">Detail Transaksi</h5>
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
<i class="fa fa-file-text-o"></i> Daftar Transaksi
@endsection

@section('title-halaman', 'Laralux.com | Daftar Transaksi')

@section('javascript')
<script>
    function getDetailData(id) {
        $.ajax({
            url: '{{ url("transactions/detail") }}/' + id,
            type: 'GET',
            success: function(data) {
                $('#modalContent').html(data);
                console.log(data);
            }
        });
    }
</script>
@endsection
@section('navigasi')
<li>
    <i class="fa fa-home"></i>
    <a href="{{ route('hotel.index') }}">Home</a>
</li>
<li>
    <i class="fa fa-angle-right"></i>
    <b>Daftar Transaksi</b>
</li>
@endsection