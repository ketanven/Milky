@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">

    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Milky Admin Dashboard</h1>
        </div>
    </div>

    <!-- Summary Boxes -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>
                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $sellerCount }}</h3>
                            <p>Active Sellers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $orderCount }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
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

            <!-- About Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">About Milky Project</h3>
                        </div>
                        <div class="card-body">
                            <p>Milky is a modern dairy products delivery platform that allows users to order daily or weekly milk, curd, and other dairy items. The admin panel allows monitoring of users, sellers, and orders efficiently.</p>
                            <p>Admins can view sales data, user registrations, product trends, and manage orders.</p>
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
        options: {
            responsive: true
        }
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
        options: {
            responsive: true
        }
    });
</script>
@endsection
