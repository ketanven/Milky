@extends('Admin.sellerlayout.app')

@section('content')
<div class="content-wrapper">

    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Milky Seller Dashboard</h1>
        </div>
    </div>

    <!-- Top Summary Boxes -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $productCount }}</h3>
                            <p>My Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pricetag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $orderCount }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>₹{{ number_format($totalRevenue,2) }}</h3>
                            <p>Total Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daily Visitors</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="visitors-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Sales</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Store Overview / About -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">About Your Store</h3>
                        </div>
                        <div class="card-body">
                            <p>Welcome {{ $seller->name }}! Here you can manage your products, track orders, and view your sales performance.</p>
                            <p>Milky project empowers sellers to sell dairy products directly to users efficiently.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxVisitors = document.getElementById('visitors-chart').getContext('2d');
    const visitorsChart = new Chart(ctxVisitors, {
        type: 'bar',
        data: {
            labels: ['Yesterday', 'Today'],
            datasets: [{
                label: 'Visitors',
                data: [{{ $dailyVisitors['yesterday'] }}, {{ $dailyVisitors['today'] }}],
                backgroundColor: ['#6c757d', '#007bff']
            }]
        },
        options: { responsive: true }
    });

    const ctxSales = document.getElementById('sales-chart').getContext('2d');
    const salesChart = new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: ['Last Month', 'This Month'],
            datasets: [{
                label: 'Sales (₹)',
                data: [{{ $monthlySales['lastMonth'] }}, {{ $monthlySales['thisMonth'] }}],
                borderColor: '#28a745',
                fill: false,
                tension: 0.3
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
