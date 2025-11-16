@extends('layout.app')
@section('content')
    <!-- Wishlist Page Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <p class="section-title bg-white text-center text-primary px-3">Wishlist</p>
                <h1 class="mb-4">Your Favorite Products</h1>
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
                                    <th>Availability</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlistItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td><img src="{{ asset('assets/img/product/' . $item->product->image) }}" width="60"
                                                alt="{{ $item->product->name }}"></td>
                                        <td>₹{{ number_format($item->product->price, 2) }}</td>
                                        <td>
                                            @if($item->product->quantity > 0)
                                                <span class="text-success">In stock</span>
                                            @else
                                                <span class="text-danger">Out of stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary rounded-pill me-2 add-to-cart-from-wishlist"
                                                data-id="{{ $item->product->id }}" @if($item->product->quantity == 0) disabled
                                                @endif>
                                                Add to Cart
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger rounded-pill remove-wishlist"
                                                data-id="{{ $item->id }}">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Page End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            // Remove from wishlist
            $('.remove-wishlist').click(function () {
                const wishlistId = $(this).data('id');

                $.post("/remove-wishlist/" + wishlistId, {
                    _token: "{{ csrf_token() }}"
                }, function (res) {
                    location.reload();
                });
            });

            // Add to cart from wishlist
            $('.add-to-cart-from-wishlist').click(function () {
                const productId = $(this).data('id');

                $.post("/add-to-cart-from-wishlist/" + productId, {
                    _token: "{{ csrf_token() }}"
                }, function (res) {
                    alert(res.message);
                    location.reload();
                });
            });
        });
    </script>



@endsection