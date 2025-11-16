@extends('layout.app')
@section('content')

<!-- Subscription Page Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <p class="section-title bg-white text-center text-primary px-3">Subscription</p>
            <h1 class="mb-4">My Subscription</h1>
            <p class="text-muted">Manage your active subscription or start a new one below.</p>
        </div>

        {{-- ✅ Success / Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger text-center">
                @foreach($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        {{-- ✅ If Subscription Exists --}}
        @if($subscription)
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-white text-center rounded-top py-3">
                            <h5 class="mb-0">Your Active Subscription</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th>Product</th>
                                        <td>{{ $subscription->product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Plan</th>
                                        <td>{{ ucfirst($subscription->plan) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $subscription->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price per delivery</th>
                                        <td>₹{{ number_format($subscription->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge bg-{{ $subscription->status == 'active' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($subscription->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Auto Renew</th>
                                        <td>{{ $subscription->auto_renew ? 'Enabled' : 'Disabled' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Start Date</th>
                                        <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-center mt-4">
                                <form action="{{ route('subscription.cancel', $subscription->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        Cancel Subscription
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            {{-- ✅ No Subscription → Show Subscription Form --}}
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-white text-center rounded-top py-3">
                            <h5 class="mb-0">Start Your Subscription</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('subscription.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <select name="product_id" id="product" class="form-select" required>
                                                <option value="">Choose product...</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }} (₹{{ $product->price }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="product">Select Product</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="plan" id="plan" class="form-select" required>
                                                <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option>
                                            </select>
                                            <label for="plan">Plan</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" name="quantity" id="quantity"
                                                class="form-control" min="1" value="1" required>
                                            <label for="quantity">Quantity</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" step="0.01" name="price" id="price"
                                                class="form-control" required>
                                            <label for="price">Price per delivery (₹)</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="payment_method" id="payment_method"
                                                class="form-select" required>
                                                <option value="cod">Cash on Delivery</option>
                                                <option value="online">Online Payment</option>
                                            </select>
                                            <label for="payment_method">Payment Method</label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mt-3">
                                        <button type="submit"
                                            class="btn btn-secondary rounded-pill py-3 px-5">
                                            Subscribe Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Subscription Page End -->

@endsection
