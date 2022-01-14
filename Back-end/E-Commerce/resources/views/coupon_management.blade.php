@extends('layouts.app')

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
                    <li class="breadcrumb-item active">Coupon Management</li>
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
                        <h3 class="card-title">Coupons</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="category" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Coupon Code</th>
                                    <th>Minimum Value</th>
                                    <th>Coupon Percentage</th>
                                    <th>Limit Value</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>&#8377; {{ $coupon->minvalue }}</td>
                                    <td>{{ $coupon->percent }}%</td>
                                    <td>&#8377; {{ $coupon->limit }}</td>
                                    <td>{{ $coupon->quantity }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning edit" data-id="{{ $coupon->id }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger delete" data-id="{{ $coupon->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></button>
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
< x-delete-alert data="Do you really want to delete this Coupon?" />
<!-- Edit modal -->
<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card card-warning card-outline">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ccode">Coupon Code</label>
                                <input type="text" class="form-control @error('ccode') is-invalid @enderror" name="ccode" disabled id="ccode" placeholder="Enter coupon code" autofocus value="{{ old('ccode') }}">
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
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</button>
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
        $('#category').DataTable();

        $(".delete").on("click", function() {
            let element = this;
            let id = $(this).data("id");
            $("#d").on("click", function() {
                $.ajax({
                    url: `/coupon-management/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest("tr").fadeOut();
                        toastr.success(`Coupon deleted successfully.`);
                    }
                });
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `/coupon-management/coupon/${id}`,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    $("#id").val(response.id);
                    $("#ccode").val(response.code);
                    $("#cmin").val(response.minvalue);
                    $("#cpercent").val(response.percent);
                    $("#climit").val(response.limit);
                    $("#cquantity").val(response.quantity);
                }
            });
        });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            let id = $("#id").val();
            let formData = new FormData(this);
            $.ajax({
                url: `/coupon-management/edit/${id}`,
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                },
            });
        });

    });
</script>
@endsection