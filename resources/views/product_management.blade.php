@extends('layouts.app')

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
                    <li class="breadcrumb-item active">Product Management</li>
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
                        <h3 class="card-title">Products</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Categories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td><div class="overflow-auto" style="max-height: 5rem; ">{{ $product->description }}</div></td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->weight }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>
                                        @foreach ($product->categories as $category)
                                        <span class="btn btn-primary m-1 p-1">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning edit my-1" href="{{ url('product-management/edit-product/' . $product->id ) }}"><i class="fas fa-pen"></i></a>
                                        <button class="btn btn-danger delete my-1" data-id="{{ $product->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></button>
                                        <a class="btn btn-primary my-1" href="{{ url('product-management/product-images/' . $product->id) }}"><i class="far fa-image"></i></a>
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
<!-- Delete model -->
< x-delete-alert data="Do you really want to delete this product? All images related to this product will also be deleted." />

@endsection
@section('script')

<script>
    $(document).ready(function() {
        $('#product').DataTable();

        $(".delete").on("click", function() {
            let element = this;
            let id = $(this).data("id");
            $("#d").on("click", function() {
                $.ajax({
                    url: `/product-management/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest("tr").fadeOut();
                        toastr.success(`Product deleted successfully.`);
                    }
                });
            });
        });

    });
</script>
@endsection