<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .highlight-bg {
        background-color: #e9ecef;
    }

    .table thead th {
        background-color: #343a40;
        color: #fff;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding: 5px;
    }

    .col-md-9 {
        flex: 0 0 75%;
        max-width: 75%;
        padding: 5px;
    }

    p {
        margin: 0;
        padding: 0;
        font-size: 16px;
    }

    strong {
        font-weight: bold;
    }
</style>

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
            <p>{{ \Carbon\Carbon::parse($firstTransaction->transaction_date)->format('d M Y, H:i') }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 highlight-bg">
            <p><strong>Hotel:</strong></p>
        </div>
        <div class="col-md-6">
            <p>{{ $firstTransaction->nama_hotel }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Rincian reservasi:</strong></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kamar yang dipesan</th>
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
            <p><strong>Total:</strong></p>
        </div>
        <div class="col-md-6">
            <p>IDR {{ number_format($firstTransaction->total, 0, ',', '.') }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>PPN (11%):</strong></p>
        </div>
        <div class="col-md-6">
            <p>IDR {{ number_format($firstTransaction->ppn, 0, ',', '.') }}</p>
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