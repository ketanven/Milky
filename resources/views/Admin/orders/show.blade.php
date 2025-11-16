@extends('Admin.layout.app')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Order Details: {{ $order->order_number }}</h3>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Orders
                    </a>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <!-- Order Info Card -->
                <div class="card shadow-sm border-primary mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order Info</h5>
                        <span>{{ $order->created_at->format('d M, Y H:i') }}</span>
                    </div>
                    <div class="card-body">
                        <p><strong>User:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ [
        'pending' => 'bg-warning text-dark',
        'confirmed' => 'bg-info text-white',
        'processing' => 'bg-primary text-white',
        'shipped' => 'bg-secondary text-white',
        'delivered' => 'bg-success',
        'cancelled' => 'bg-danger',
        'returned' => 'bg-dark text-white'
    ][$order->order_status] ?? 'bg-secondary' }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Items Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Items</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover mb-0">
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
                                        <td>₹{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₹{{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Delivery & Total -->
                <div class="card shadow-sm mb-4 border-info">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Delivery & Total</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Address:</strong> {{ $order->address->address_line }}, {{ $order->address->city }},
                            {{ $order->address->state }} - {{ $order->address->pincode }}</p>
                        <p><strong>Delivery Slot:</strong> {{ $order->deliverySlot->slot_name ?? '-' }}</p>
                        <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

                <!-- Status History Card -->
                <div class="card shadow-sm mb-4 border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Status History</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($order->statusHistory as $history)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center
                                                            {{ [
                                    'pending' => 'list-group-item-warning',
                                    'confirmed' => 'list-group-item-info',
                                    'processing' => 'list-group-item-primary',
                                    'shipped' => 'list-group-item-secondary',
                                    'delivered' => 'list-group-item-success',
                                    'cancelled' => 'list-group-item-danger',
                                    'returned' => 'list-group-item-dark'
                                ][$history->status] ?? '' }}">
                                                        {{ ucfirst($history->status) }}
                                                        <span
                                                            class="badge bg-light text-dark">{{ $history->created_at->format('d M, Y H:i') }}</span>
                                                    </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Update Status Card -->
                @if($order->order_status !== 'cancelled')
                    <div class="card shadow-sm mb-4 border-success">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Update Status</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-4">
                                        <select name="status" class="form-select form-control" required>
                                            <option value="">Select Status</option>
                                            @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'] as $status)
                                                <option value="{{ $status }}" @if($order->order_status == $status) selected @endif>
                                                    {{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="note" class="form-control" placeholder="Optional note">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success w-100">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        This order has been cancelled. Status cannot be updated.
                    </div>
                @endif


            </div>
        </section>
    </div>

@endsection