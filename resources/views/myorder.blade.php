@extends('layout.app')
@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <!-- Header -->
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <p class="section-title bg-white text-center text-primary px-3">My Orders</p>
            <h1 class="mb-4 fw-bold">Track Your Recent Orders</h1>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Orders List -->
        @forelse($orders as $order)
            <div class="card shadow-sm mb-4 border-primary">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Order: {{ $order->order_number }}</h5>
                    <span>{{ $order->created_at->format('d M, Y H:i') }}</span>
                </div>
                <div class="card-body">
                    <!-- Status -->
                    @php
                        $statusClass = [
                            'pending'=>'badge-warning',
                            'confirmed'=>'badge-info',
                            'processing'=>'badge-primary',
                            'shipped'=>'badge-secondary',
                            'delivered'=>'badge-success',
                            'cancelled'=>'badge-danger',
                            'returned'=>'badge-dark'
                        ];
                    @endphp
                    <p>Status: <span class="badge {{ $statusClass[$order->order_status] ?? 'badge-secondary' }}">{{ ucfirst($order->order_status) }}</span></p>

                    <!-- Items -->
                    <h6 class="fw-bold mt-3">Items ({{ $order->orderItems->sum('quantity') }}):</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>₹{{ number_format($item->price,2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₹{{ number_format($item->subtotal,2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Delivery Info -->
                    <h6 class="fw-bold mt-3">Delivery Information:</h6>
                    <div class="p-3 mb-3 border rounded">
                        <p><strong>Address:</strong> {{ $order->address->address_line }}, {{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</p>
                        <p><strong>Delivery Slot:</strong> {{ $order->deliverySlot->slot_name ?? '-' }}</p>
                        <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    </div>

                    <!-- Status History -->
                    <h6 class="fw-bold">Status History:</h6>
                    <ul class="list-group mb-3">
                        @foreach($order->statusHistory as $history)
                            @php
                                $historyClass = [
                                    'pending'=>'list-group-item-warning',
                                    'confirmed'=>'list-group-item-info',
                                    'processing'=>'list-group-item-primary',
                                    'shipped'=>'list-group-item-secondary',
                                    'delivered'=>'list-group-item-success',
                                    'cancelled'=>'list-group-item-danger',
                                    'returned'=>'list-group-item-dark'
                                ];
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center {{ $historyClass[$history->status] ?? '' }}">
                                {{ ucfirst($history->status) }}
                                <span class="badge bg-light text-dark">{{ $history->created_at->format('d M, Y H:i') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Cancel Order -->
                    @if(!in_array($order->order_status, ['cancelled','delivered']))
                        <form action="{{ route('order.cancel', $order->id) }}" method="POST" class="text-end">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-pill">Cancel Order</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">No orders found.</div>
        @endforelse

        <div class="text-end mt-4">
            <a href="{{ route('product') }}" class="btn btn-outline-secondary rounded-pill px-4">Back to Products</a>
        </div>
    </div>
</div>

@endsection
