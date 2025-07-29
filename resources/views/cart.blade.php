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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart Item 1 -->
                            <tr>
                                <td>Fresh Milk (1L)</td>
                                <td><img src="img/product-1.jpg" alt="Milk" width="60"></td>
                                <td>₹60</td>
                                <td>
                                    <input type="number" class="form-control text-center" value="2" min="1" style="width: 70px;">
                                </td>
                                <td>₹120</td>
                                <td><a href="#" class="btn btn-sm btn-outline-danger rounded-pill">Remove</a></td>
                            </tr>
                            <!-- Cart Item 2 -->
                            <tr>
                                <td>Paneer (500g)</td>
                                <td><img src="img/product-2.jpg" alt="Paneer" width="60"></td>
                                <td>₹150</td>
                                <td>
                                    <input type="number" class="form-control text-center" value="1" min="1" style="width: 70px;">
                                </td>
                                <td>₹150</td>
                                <td><a href="#" class="btn btn-sm btn-outline-danger rounded-pill">Remove</a></td>
                            </tr>
                            <!-- Total Row -->
                            <tr class="fw-bold">
                                <td colspan="4" class="text-end">Total</td>
                                <td colspan="2">₹270</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-3">
                        <a href="#" class="btn btn-outline-secondary rounded-pill px-4 me-2">Continue Shopping</a>
                        <a href="#" class="btn btn-primary rounded-pill px-4">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

@endsection
