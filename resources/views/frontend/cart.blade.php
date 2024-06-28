@extends('layout.conquer2')
@section('isi')

<style>
    .cart-page-inner {
        border: 1px solid #e0e0e0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        margin-bottom: 20px;
    }

    .coupon {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .coupon input[type="text"] {
        width: calc(100% - 100px);
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 5px 0 0 5px;
    }

    .coupon button {
        padding: 10px 20px;
        border: none;
        background-color: #007bff;
        color: white;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .coupon button:hover {
        background-color: #0056b3;
    }

    .cart-summary {
        padding: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .cart-content h1 {
        margin-bottom: 20px;
        font-size: 24px;
    }

    .cart-content h2 {
        font-size: 20px;
        color: #007bff;
    }

    .cart-btn {
        display: flex;
        justify-content: space-between;
    }

    .cart-btn a {
        padding: 10px 20px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        transition: background-color 0.3s;
    }

    .cart-btn .btn-primary {
        background-color: #007bff;
    }

    .cart-btn .btn-primary:hover {
        background-color: #0056b3;
    }

    .cart-btn .btn-success {
        background-color: #28a745;
    }

    .cart-btn .btn-success:hover {
        background-color: #218838;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="cart-page-inner">
                <div class="table-responsive">
                    @php
                    $total = 0;
                    @endphp
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(session('cart', []) as $item)
                            <tr>
                                <td>
                                    <div class="product-details">
                                        <p style="font-weight:bold">{{ $item['name'] }}</p>
                                        <img height="100px" src="{{ asset('images/products/' . $item['id'] . '.jpg') }}" alt="Image">
                                    </div>
                                </td>
                                <td>{{ 'IDR '. number_format($item['price'], 0, ',', '.') }}</td>
                                <td>
                                    <div class="qty">
                                        <button onclick="redQty({{ $item['id'] }})" class="btn-minus"><i class="fa fa-minus-square"></i></button>
                                        <input type="text" value="{{ $item['quantity'] }}" size="{{ strlen($item['quantity']) }}" style="text-align: center;" readonly>
                                        <button onclick="addQty({{ $item['id'] }})" class="btn-plus"><i class="fa fa-plus-square"></i></button>
                                    </div>
                                </td>
                                <td>{{ 'IDR '. number_format($item['quantity'] * $item['price'], 0, ',', '.') }}</td>
                                <td><a class="btn btn-danger" href="{{route('delFromCart',$item['id'])}}"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @php
                            $total += $item['quantity'] * $item['price'];
                            @endphp
                            @empty
                            <tr>
                                <td colspan="5">
                                    <p>Tidak ada item di cart.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="cart-page-inner">
                <div class="coupon">
                    <input type="text" placeholder="Coupon Code">
                    <button>Apply Code</button>
                </div>

                <div class="cart-summary">
                    <div class="cart-content">
                        <h1>Cart Summary</h1>
                        <div style="padding-left: 20px;"> <!-- Mengatur indentasi dengan padding -->
                            <h4>Grand Total: {{ 'IDR '. number_format($total, 0, ',', '.') }}</h4>
                            @php
                            $ppn = $total * 0.11; // Menghitung PPN (11% dari grand total)
                            $grandTotal = $total + $ppn; // Menambahkan PPN ke grand total
                            @endphp
                            <h4>PPN (11%): {{ 'IDR '. number_format($ppn, 0, ',', '.') }}</h4>
                        </div>
                        <h2>Total (including PPN): {{ 'IDR '. number_format($grandTotal, 0, ',', '.') }}</h2>
                    </div>

                    <div class="cart-btn">

                        <a href="{{ route('hotel.index') }}" class="btn btn-xs btn-primary">Continue Shopping</a>
                        <a href="{{ route('checkout') }}" class="btn btn-xs btn-success">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('judul-halaman')
<i class="fa fa-shopping-cart fa-5x"></i> Cart
@endsection

@section('title-halaman', 'Laralux.com | Daftar Hotel')

@section('javascript')
<script>
    function redQty(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("redQty")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                location.reload();
            }
        });
    }

    function addQty(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("addQty")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                alert('Gagal menambah kuantitas barang: ' + xhr.responseText);
            }
        });
    }
</script>
@endsection