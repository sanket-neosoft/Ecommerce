@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Category Management</li>
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
                        <h3 class="card-title">Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="orders" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->tracking_id }}</td>
                                    <td>{{ $order->product->name }}-({{ $order->product->brand }})</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->user_order->payment_method }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning edit" data-id="{{ $order->id }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pen"></i></button>

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
<!-- Edit modal -->
<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card card-warning card-outline">
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="edit-form">
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Order Id</strong>
                                    <p class="text-muted" id="order-id">
                                    </p>

                                    <hr>

                                    <strong>Product</strong>
                                    <p class="text-muted mb-0" id="product-id"></p>
                                    <p class="text-muted mb-0" id="product-name"></p>
                                    <p class="text-muted mb-0" id="product-quantity"></p>
                                    <p class="text-muted" id="product-price">Price: 17999</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>User Details</strong>
                                    <p class="text-muted mb-0" id="user-name">
                                        Name
                                    </p>
                                    <p class="text-muted mb-0" id="user-email">
                                        email:
                                    </p>
                                    <p class="text-muted" id="user-contact">
                                        contact:
                                    </p>
                                    <hr>
                                    <strong>Address</strong>
                                    <p class="text-muted" id="user-address">
                                        Address
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select class="form-control" id="status" name="status">
                                <option id="step1">Yet to be Dispatched</option>
                                <option id="step2">Dispatched</option>
                                <option id="step3">Shipped</option>
                                <option id="step4">Arriving Today</option>
                                <option id="step5">Delivered</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="current-status">Current Status</label>
                            <input type="text" class="form-control" id="current-status" disabled>
                        </div>
                    </div>
                    <input type="hidden" id="id">
                    <input type="hidden" name="quantity" id="quantity">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection
@section('script')

<script>
    $(document).ready(function() {
        $('#orders').DataTable();

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `/order-management/order/${id}`,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    $("#id").val(response.order.id);
                    $("#quantity").val(response.order.quantity);
                    $("#order-id").text(response.order.tracking_id);
                    $("#product-id").text(`Product Id: ${response.order.product_id}`);
                    $("#product-name").text(`Product Name: ${response.order.product.name}`);
                    $("#product-quantity").text(`Quantity: ${response.order.quantity}`);
                    $("#product-price").html(`Product Price: &#8377;${response.order.product.price}`);
                    $("#user-name").text(`Name: ${response.order.user_order.user_name}`);
                    $("#user-email").text(`Email: ${response.order.user_order.user_email}`);
                    $("#user-address").text(`Address: ${response.order.user_order.user_address}`);
                    $("#user-contact").text(`Contact No: ${response.order.user_order.user_contact}`);
                    $("#current-status").val(response.order.status);
                    switch (response.order.status) {
                        case "Yet to be Dispatched":
                            $("#step1").prop('disabled', true);
                            $("#step1").prop('selected', true);
                            break;
                        case "Dispatched":
                            $("#step1").prop('disabled', true);
                            $("#step2").prop('disabled', true);
                            $("#step2").prop('selected', true);
                            break;
                        case "Shipped":
                            $("#step1").prop('disabled', true);
                            $("#step2").prop('disabled', true);
                            $("#step3").prop('disabled', true);
                            $("#step3").prop('selected', true);
                            break;
                        case "Arriving Today":
                            $("#step1").prop('disabled', true);
                            $("#step2").prop('disabled', true);
                            $("#step3").prop('disabled', true);
                            $("#step4").prop('disabled', true);
                            $("#step4").prop('selected', true);

                            break;
                        default:
                            $("#step1").prop('disabled', true);
                            $("#step2").prop('disabled', true);
                            $("#step3").prop('disabled', true);
                            $("#step4").prop('disabled', true);
                            $("#step5").prop('disabled', true);
                            $("#step5").prop('selected', true);
                    }
                }
            });
        });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            let id = $("#id").val();
            let formData = new FormData(this);
            $.ajax({
                url: `/order-management/edit/${id}`,
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response === 'success') {
                        location.reload();
                        toastr.success('Status updated sucessfully.');
                    } else {
                        toastr.error('Status update failed');
                    }
                },
            });
        });

    });
</script>
@endsection