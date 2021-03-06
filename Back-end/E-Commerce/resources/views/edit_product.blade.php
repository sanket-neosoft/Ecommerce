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
                <h1>Product Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/product-management') }}">Product Management</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ url('product-management/edit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pname">Product Name</label>
                                    <input type="text" class="form-control @error('pname') is-invalid @enderror" name="pname" id="pname" placeholder="Enter product name" value="{{ $product->name }}">
                                    @error('pname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Product Description (optional)</label>
                                    <textarea class="form-control" rows="8" placeholder="Enter product description" name="pdescription">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pcategory">Product Category</label>
                                    <input type="text" class="form-control @error('pcategory') is-invalid @enderror" name="pcategory" id="pcategory" placeholder="Select category" value="">
                                    @error('pcategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pbrand">Product Brand</label>
                                    <input type="text" class="form-control @error('pbrand') is-invalid @enderror" name="pbrand" id="pbrand" placeholder="Enter product brand" value="{{ $product->brand }}">
                                    @error('pbrand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pquantity">Product Quantity</label>
                                    <input type="number" min="0" class="form-control @error('pquantity') is-invalid @enderror" name="pquantity" id="pquantity" placeholder="Enter product quantity" autofocus value="{{ $product->quantity }}">
                                    @error('pquantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pprice">Product Price</label>
                                    <input type="number" class="form-control @error('pprice') is-invalid @enderror" name="pprice" id="pprice" placeholder="Enter product price" value="{{ $product->price }}">
                                    @error('pprice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pthumbnail">Product Thumbnail</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('pthumbnail') is-invalid @enderror" id="pthumbnail" name="pthumbnail">
                                        <label class="custom-file-label" for="pthumbnail">Choose file</label>
                                    </div>
                                </div>
                                @error('pimages')
                                <span class="text-danger" role="alert">
                                    <small><strong>{{ $message }}</strong></small>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pimages">Product Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('pimages') is-invalid @enderror" id="pimages" name="pimages[]" multiple>
                                        <label class="custom-file-label" for="pimages">Choose file</label>
                                    </div>
                                </div>
                                @error('pimages')
                                <span class="text-danger" role="alert">
                                    <small><strong>{{ $message }}</strong></small>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="customSwitch3">Featured</label>
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" value="1" name="pfeatured">
                                    <label class="custom-control-label" for="customSwitch3"></label>
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
@php
$categories_list = [];
foreach($categories as $category) {
$item = [];
$item['value'] = strval($category->id);
$item['label'] = $category->name;
array_push($categories_list, $item);
}
$existing_list = [];
foreach($product->categories as $category) {
$item = [];
$item['value'] = strval($category->id);
$item['label'] = $category->name;
array_push($existing_list, $item);
}
@endphp

@endsection
@section('script')

<!-- toastr Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (session('status') === "success")

<!-- toastr success -->
<script>
    toastr.success("Product Updated Successfully");
</script>

@elseif (session('status') === "failed")

<!-- toastr danger  -->
<script>
    toastr.error("Failed to update product.");
</script>
@endif

<script type="text/javascript">
    $(function() {
        var sourceDataObj = JSON.parse('{!! json_encode($categories_list) !!}');
        var existingDataObj = JSON.parse('{!! json_encode($existing_list) !!}');
        $('#pcategory').tokenfield({
            autocomplete: {
                source: sourceDataObj,
                delay: 100
            },
            showAutocompleteOnFocus: true
        });

        $('#pcategory').tokenfield('setTokens', existingDataObj);

        $('#pcategory').on('tokenfield:createtoken', function(event) {
            var existingTokens = $(this).tokenfield('getTokens');
            var exists = true;
            //PREVENT DUPLICATION
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
            //ALLOW ONLY TOKENS FROM SOURCE
            $.each(sourceDataObj, function(index, token) {
                if (token.value === event.attrs.value)
                    exists = false;
            });
            if (exists === true)
                event.preventDefault();
        });
    });
</script>

@if ($product->featured)
<script>
    $("#customSwitch3").prop('checked', true);
</script>
@endif

@endsection