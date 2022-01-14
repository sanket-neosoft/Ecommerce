@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Coupon Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/coupon-management') }}">Coupon Management</a></li>
                    <li class="breadcrumb-item active">Add Coupon</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ url('coupon-management/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ccode">Coupon Code</label>
                                    <input type="text" class="form-control @error('ccode') is-invalid @enderror" name="ccode" id="ccode" placeholder="Enter coupon code" autofocus value="{{ old('ccode') }}">
                                    @error('ccode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cmin">Coupon Minimum Value</label>
                                    <input type="number" class="form-control @error('cmin') is-invalid @enderror" name="cmin" id="cmin" placeholder="Enter minimum amount" value="{{ old('cmin') }}">
                                    @error('cmin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpercent">Coupon Percentage</label>
                                    <input type="number" class="form-control @error('cpercent') is-invalid @enderror" name="cpercent" id="cpercent" placeholder="Enter percentage" value="{{ old('cpercent') }}">
                                    @error('cpercent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="climit">Coupon Limit</label>
                                    <input type="number" class="form-control @error('climit') is-invalid @enderror" name="climit" id="climit" placeholder="Enter coupon limit" value="{{ old('climit') }}">
                                    @error('climit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cquantity">Coupon Quantity</label>
                                    <input type="number" class="form-control @error('ccode') is-invalid @enderror" name="cquantity" id="cquantity" placeholder="Enter coupon quantity" value="{{ old('cquantity') }}">
                                    @error('cquantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')

<!-- Preview image JS  -->
<script>
    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>

<!-- toastr Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (session('status') === "success")

<!-- toastr success -->
<script>
    toastr.success("Coupon Added Successfully");
</script>

@elseif (session('status') === "failed")

<!-- toastr danger  -->
<script>
    toastr.error("Failed to add Coupon.");
</script>

@endif
@endsection