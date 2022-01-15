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
                <h1>CMS Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/cms-management') }}">Category Management</a></li>
                    <li class="breadcrumb-item active">Add CMS</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add CMS</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ url('cms-management/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="ctitle">CMS Title</label>
                                        <input type="text" class="form-control @error('ctitle') is-invalid @enderror" name="ctitle" id="ctitle" placeholder="Enter cms title" value="{{ old('ctitle') }}">
                                        @error('ctitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cslug">CMS Slug</label>
                                        <input type="text" class="form-control @error('cslug') is-invalid @enderror" name="cslug" id="ctitle" placeholder="Enter cms slug" value="{{ old('cslug') }}">
                                        @error('cslug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="banner-image">CMS Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('cimage') is-invalid @enderror" id="banner-image" name="cimage" onchange="showPreview(event)">
                                                <label class="custom-file-label" for="banner-image">Choose file</label>
                                            </div>
                                        </div>
                                        @error('cimage')
                                        <span class="text-danger" role="alert">
                                            <small><strong>{{ $message }}</strong></small>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <div class="border rounded preview">
                                            <img id="preview" src="https://www.cellmax.eu/wp-content/uploads/2020/01/Hero-Banner-Placeholder-Dark-1024x480-1.png" style="width: 100%; height: 14rem; object-fit: cover; object-position: center" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cdescription">CMS Description</label>
                                        <textarea class="form-control @error('cdescription') is-invalid @enderror" rows="18" placeholder="Enter description" id="cdescription" name="cdescription">{{ old('cdescription') }}</textarea>
                                        @error('cdescription')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
    toastr.success("Category Added Successfully");
</script>

@elseif (session('status') === "failed")

<!-- toastr danger  -->
<script>
    toastr.error("Failed to add category.");
</script>

@endif
@endsection