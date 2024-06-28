@extends('layout.conquer2')
@section('isi')

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
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(session('cart', []) as $item)
                            <tr>
                                <td>
                                    <div class="product-details">
                                        <p>{{ $item['name'] }}</p>
                                        <img height="200px" src="{{ asset('images/products/' . $item['id'] . '.jpg') }}" alt="Image">
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
                        <h2>Grand Total: {{ 'IDR '. number_format($total, 0, ',', '.') }}</h2>
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
@section('judul-halaman', 'Cart')
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
            }
        });
    }
</script>
@endsection