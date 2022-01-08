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
                        <table id="category" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning edit" data-id="{{ $category->id }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger delete" data-id="{{ $category->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></button>
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
< x-delete-alert data="Do you really want to delete this category?" />
<!-- Edit modal -->
<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
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
                    <div class="form-group">
                        <label for="cname">Category Name</label>
                        <input type="text" class="form-control @error('cname') is-invalid @enderror" name="cname" disabled id="cname" placeholder="Enter category name" autofocus value="{{ old('cname') }}">
                        @error('bname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cdescription">Category Description (Optional)</label>
                        <textarea class="form-control @error('cname') is-invalid @enderror" rows="6" placeholder="Enter description" id="cdescription" name="cdescription"></textarea>
                        @error('cdescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                    url: `/category-management/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest("tr").fadeOut();
                        toastr.success(`Category deleted successfully.`);
                    }
                });
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `/category-management/category/${id}`,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    $("#cname").val(response.name);
                    $("#cdescription").val(response.description);
                    $("#id").val(response.id);
                }
            });
        });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            let id = $("#id").val();
            let formData = new FormData(this);
            $.ajax({
                url: `/category-management/edit/${id}`,
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