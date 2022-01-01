@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $product->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/product-management/') }}">Product Management</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
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
                        <h3 class="card-title"> Images</h3>
                        <div class="text-right">
                            <a href="{{ url('/product-management/edit/' . $product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pen mr-1"></i> Add Images</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            @foreach ($product->images as $image)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block; object-position: center; object-fit: cover" src="{{ asset('/products/' . $image->image) }}" data-holder-rendered="true">
                                    <div class="card-body p-2 text-right">
                                        <button type="button" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#modal-delete" data-id="{{ $image->id }}"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
<!-- Delete model -->
< x-delete-alert data="Do you really want to delete this Image?" />

@endsection
@section('script')

<script>
    $(document).ready(function() {

        $(".delete").on("click", function() {
            let element = this;
            let id = $(this).data("id");
            $("#d").on("click", function() {
                $.ajax({
                    url: `/product-management/product-image/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest(".col-md-4").fadeOut();
                        toastr.success(`Product Image deleted successfully.`);
                    }
                });
            });
        });

    });
</script>
@endsection