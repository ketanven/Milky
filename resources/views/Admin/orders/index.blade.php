@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="mb-0">Orders</h3>
            </div>

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped mb-0 align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#Order ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    <td>{{ $order->created_at->format('d M, Y H:i') }}</td>
                                    <td>{{ $order->orderItems->sum('quantity') }} item(s)</td>
                                    <td>₹{{ number_format($order->total_amount,2) }}</td>
                                    <td>
                                        <span class="badge 
                                            {{
                                                [
                                                    'pending'=>'bg-warning text-dark',
                                                    'confirmed'=>'bg-info text-white',
                                                    'processing'=>'bg-primary text-white',
                                                    'shipped'=>'bg-secondary text-white',
                                                    'delivered'=>'bg-success',
                                                    'cancelled'=>'bg-danger',
                                                    'returned'=>'bg-dark text-white'
                                                ][$order->order_status] ?? 'bg-secondary'
                                            }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                           <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-3">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </section>
</div>

{{-- Bootstrap & Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
