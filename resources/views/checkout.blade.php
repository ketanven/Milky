@extends('layout.app')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <p class="section-title bg-white text-center text-primary px-3">Checkout</p>
                <h1 class="mb-4">Confirm Your Order</h1>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('checkout.placeOrder') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Shipping Address</h4>
                        <select name="address_id" class="form-control mb-3">
                            <option value="">Select Address</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}">
                                    {{ $address->address_line }}, {{ $address->city }}, {{ $address->state }},
                                    {{ $address->pincode }}
                                    @if($address->is_default) (Default) @endif
                                </option>
                            @endforeach
                        </select>

                        <h5>Or Enter New Address</h5>
                        <input type="text" name="address_line" placeholder="Address Line" class="form-control mb-2">
                        <input type="text" name="city" placeholder="City" class="form-control mb-2">
                        <input type="text" name="state" placeholder="State" class="form-control mb-2">
                        <input type="text" name="pincode" placeholder="Pincode" class="form-control mb-2">
                        <input type="text" name="landmark" placeholder="Landmark (Optional)" class="form-control mb-2">

                        <h4>Delivery Slot</h4>
                        <select name="delivery_slot_id" class="form-control mb-3" required>
                            <option value="">Select Delivery Slot</option>
                            @foreach($slots as $slot)
                                <option value="{{ $slot->id }}">
                                    {{ $slot->slot_name }} ({{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} -
                                    {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }})
                                </option>
                            @endforeach
                        </select>

                        <h4>Payment Method</h4>
                        <select name="payment_method" class="form-control mb-3" required>
                            <option value="">Select Payment Method</option>

                            <option value="subscription">By Subscription</option>
                            <option value="cod">Cash on Delivery</option>
                            <option value="online">Online Payment</option>
                        </select>

                        <div id="stripe-button-container" style="display:none;" class="mt-2">
                            <button type="button" id="stripe-button" class="btn btn-primary rounded-pill px-4">
                                Pay with Stripe (Test)
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h4>Order Summary</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cartItems as $item)
                                    @php $subtotal = $item->quantity * $item->product->price;
                                    $total += $subtotal; @endphp
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₹{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td colspan="2">Total</td>
                                    <td>₹{{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- ✅ Subscription Section --}}
                        @if(isset($subscription) && $subscription)
                            <div class="card mt-4 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Your Active Subscription</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Product:</strong> {{ $subscription->product->name ?? 'N/A' }}</p>
                                    <p><strong>Plan:</strong> {{ ucfirst($subscription->plan) }}</p>
                                    <p><strong>Quantity:</strong> {{ $subscription->quantity }}</p>
                                    <p><strong>Price:</strong> ₹{{ number_format($subscription->price, 2) }}</p>
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-success text-white">{{ ucfirst($subscription->status) }}</span>
                                    </p>
                                    <p><strong>Start Date:</strong>
                                        {{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</p>
                                    <div class="text-end">
                                        <a href="{{ route('subscription.cancel', $subscription->id) }}"
                                            class="btn btn-danger btn-sm rounded-pill px-3"
                                            onclick="return confirm('Are you sure you want to cancel this subscription?')">
                                            Cancel Subscription
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('cart') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">Back to Cart</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Place Order</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
<script>
    const paymentSelect = document.getElementById('payment_method');
    const stripeButtonContainer = document.getElementById('stripe-button-container');
    const stripeButton = document.getElementById('stripe-button');

    paymentSelect.addEventListener('change', function() {
        stripeButtonContainer.style.display = (this.value === 'online') ? 'block' : 'none';
    });

    stripeButton.addEventListener('click', async function() {
        // Send AJAX to server to create Stripe Checkout session
        const formData = new FormData(document.querySelector('form'));
        const response = await fetch("{{ route('checkout.stripeSession') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        });
        const data = await response.json();

        if(data.sessionId){
            const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // Your test public key
            stripe.redirectToCheckout({ sessionId: data.sessionId });
        } else {
            alert('Error creating Stripe session.');
        }
    });
</script>
@endsection