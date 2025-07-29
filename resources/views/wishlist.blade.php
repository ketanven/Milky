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
                            <!-- Wishlist Item 1 -->
                            <tr>
                                <td>Organic Ghee (500ml)</td>
                                <td><img src="img/product-3.jpg" alt="Ghee" width="60"></td>
                                <td>₹350</td>
                                <td><span class="text-success">In Stock</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary rounded-pill me-2">Add to Cart</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger rounded-pill">Remove</a>
                                </td>
                            </tr>
                            <!-- Wishlist Item 2 -->
                            <tr>
                                <td>Flavored Milk (200ml)</td>
                                <td><img src="img/product-4.jpg" alt="Flavored Milk" width="60"></td>
                                <td>₹40</td>
                                <td><span class="text-danger">Out of Stock</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary rounded-pill me-2 disabled">Add to Cart</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger rounded-pill">Remove</a>
                                </td>
                            </tr>
                            <!-- Add more rows if needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist Page End -->


@endsection
