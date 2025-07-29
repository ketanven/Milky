@extends('layout.app')
@section('content')

<!-- My Orders Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <p class="section-title bg-white text-center text-primary px-3">My Orders</p>
            <h1 class="mb-4">Track Your Recent Orders</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive wow fadeInUp" data-wow-delay="0.1s">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>#Order ID</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Order Row 1 -->
                            <tr>
                                <td>#ORD1234</td>
                                <td>28 Jul 2025</td>
                                <td>2 x Milk, 1 x Paneer</td>
                                <td>₹350</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">View</a></td>
                            </tr>
                            <!-- Order Row 2 -->
                            <tr>
                                <td>#ORD1233</td>
                                <td>26 Jul 2025</td>
                                <td>1 x Ghee</td>
                                <td>₹220</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">View</a></td>
                            </tr>
                            <!-- Order Row 3 -->
                            <tr>
                                <td>#ORD1231</td>
                                <td>24 Jul 2025</td>
                                <td>3 x Butter</td>
                                <td>₹450</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary rounded-pill">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-end mt-3">
                        <a href="#" class="btn btn-secondary rounded-pill px-4">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Orders End -->



@endsection
