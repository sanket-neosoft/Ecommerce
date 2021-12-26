@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Banner Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Banner Management</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Banners</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Banner Name</th>
                                    <th>Banner Link</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                <tr>
                                    <td><img src="{{ url('banners/' . $banner->banner_image) }}" alt="{{ $banner->banner_image }}" style="height: 5rem; object-fit: cover; object-position: center"></td>
                                    <td>{{ $banner->banner_name }}</td>
                                    <td>{{ $banner->banner_link }}</td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')
<!-- datatable  cdn -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection