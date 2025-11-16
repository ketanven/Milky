@extends('layout.app')
@section('content')
<!-- Cart Page Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <p class="section-title bg-white text-center text-primary px-3">Your Cart</p>
            <h1 class="mb-4">Review Your Selected Items</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive wow fadeInUp" data-wow-delay="0.1s">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; $hasOutOfquantity = false; @endphp
                            @foreach($cartItems as $item)
                                @php 
                                    $subtotal = $item->quantity * $item->product->price;
                                    $total += $subtotal; 
                                    $outOfquantity = $item->product->quantity < 1;
                                    if($outOfquantity) $hasOutOfquantity = true;
                                @endphp
                                <tr @if($outOfquantity) class="table-danger" @endif>
                                    <td>{{ $item->product->name }}</td>
                                    <td><img src="{{ asset('assets/img/product/' . $item->product->image) }}" width="60" alt="{{ $item->product->name }}"></td>
                                    <td>₹{{ number_format($item->product->price, 2) }}</td>
                                    <td>
                                        <input type="number" class="form-control text-center quantity-input" 
                                               value="{{ $item->quantity }}" min="1" style="width: 70px;"
                                               data-id="{{ $item->id }}"
                                               @if($outOfquantity) disabled @endif>
                                    </td>
                                    <td>₹{{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        @if($outOfquantity)
                                            <span class="text-danger fw-bold">Out of quantity</span>
                                        @else
                                            <span class="text-success fw-bold">In quantity</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill remove-cart" data-id="{{ $item->id }}">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td colspan="4" class="text-end">Total</td>
                                <td colspan="3">₹{{ number_format($total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-3">
    <a href="{{ route('product') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">
        Continue Shopping
    </a>

    @if($hasOutOfquantity)
        <button class="btn btn-primary rounded-pill px-4" disabled>
            Proceed to Checkout
        </button>
    @else
        <a href="{{ route('checkout') }}" class="btn btn-primary rounded-pill px-4">
            Proceed to Checkout
        </a>
    @endif
</div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    // Update quantity
    $('.quantity-input').change(function () {
        const cartId = $(this).data('id');
        const quantity = $(this).val();

        $.post("/update-cart/" + cartId, {
            _token: "{{ csrf_token() }}",
            quantity: quantity
        }, function (res) {
            location.reload();
        });
    });

    // Remove item
    $('.remove-cart').click(function () {
        const cartId = $(this).data('id');

        $.post("/remove-cart/" + cartId, {
            _token: "{{ csrf_token() }}"
        }, function (res) {
            location.reload();
        });
    });
});
</script>
@endsection
