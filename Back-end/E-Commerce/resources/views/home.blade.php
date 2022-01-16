@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $user_count }}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ url('/download-users-pdf') }}" class="small-box-footer">Download User List <i class="fas fa-arrow-circle-down"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $products_sales }}</h3>

                        <p>Product Sales</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ url('/download-products-pdf') }}" class="small-box-footer">Download Product List <i class="fas fa-arrow-circle-down"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $coupon_used }}</h3>

                        <p>Coupon Used</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ url('/download-coupons-pdf') }}" class="small-box-footer">Download Coupon List <i class="fas fa-arrow-circle-down"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <!-- DONUT CHART -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Categories</h3>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="categories" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->

@php
$categories_label = [];
$categories_count = [];
foreach($categories as $category) {
array_push($categories_count, count($category->products));
array_push($categories_label, $category->name);
}
@endphp

@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // Product
    const pie = document.getElementById('categories').getContext('2d');
    let doughnut_data = JSON.parse('{!! json_encode($categories_count) !!}');
    let labels = JSON.parse('{!! json_encode($categories_label) !!}');
    const pieChart = new Chart(pie, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: doughnut_data,
                backgroundColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(220, 53, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(23, 162, 184, 1)',
                    'rgba(102, 16, 242, 1)',
                    'rgba(240, 18, 190, 1)',
                    'rgba(255, 133, 27, 1)',
                    'rgba(1, 255, 112, 1)',
                    'rgba(60, 141, 188, 1)',
                    'rgba(96, 92, 168, 1)',
                    'rgba(232, 62, 140, 1)',
                    'rgba(57, 204, 204, 1)',
                    'rgba(216, 27, 96, 1)',
                    'rgba(61, 153, 112, 1)',
                    'rgba(0, 31, 63, 1)',
                    'rgba(108, 117, 125, 1)',
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>

@endsection