@php $firstTransaction = $transaction->first(); @endphp

@if ($transaction->isEmpty())
<p>Tidak ada transaksi yang ditemukan.</p>
@else
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 highlight-bg">
            <p><strong>ID Transaksi:</strong></p>
        </div>
        <div class="col-md-6">
            <p>ID{{ $firstTransaction->transactions_id }}{{ \Carbon\Carbon::parse($firstTransaction->transaction_date)->format('dmY') }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 highlight-bg">
            <p><strong>Nama Pemesan:</strong></p>
        </div>
        <div class="col-md-6">
            <p>{{ $firstTransaction->name }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 highlight-bg">
            <p><strong>Tanggal Transaksi:</strong></p>
        </div>
        <div class="col-md-6">
            <p>{{ $firstTransaction->transaction_date }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Total:</strong></p>
        </div>
        <div class="col-md-6">
            <p>IDR {{ number_format($firstTransaction->total, 0, ',', '.') }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>PPN:</strong></p>
        </div>
        <div class="col-md-6">
            <p>IDR {{ number_format($firstTransaction->ppn, 0, ',', '.') }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Items:</strong></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $trans)
                        <tr>
                            <td>{{ $trans->nama }}</td>
                            <td>{{ $trans->quantity }}</td>
                            <td>IDR {{ number_format($trans->sub_total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Poin yang Didapat:</strong></p>
        </div>
        <div class="col-md-6">
            <p>{{ $firstTransaction->points }}</p>
        </div>
    </div>
</div>
@endif