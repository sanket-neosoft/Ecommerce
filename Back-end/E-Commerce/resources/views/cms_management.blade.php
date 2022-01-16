@extends('layouts.app')

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
                    <li class="breadcrumb-item active">CMS Management</li>
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
                        <h3 class="card-title">CMS</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="CMS" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>CMS Title</th>
                                    <th>CMS Description</th>
                                    <th>CMS Slug</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cmss as $cms)
                                <tr>
                                    <td><img src="{{ url($cms->image) }}" style="height: 5rem; object-fit: cover; object-position: center"></td>
                                    <td>{{ $cms->title }}</td>
                                    <td>
                                        <div class="overflow-auto" style="max-height: 5rem; ">{{ $cms->description }}</div>
                                    </td>
                                    <td>{{ $cms->slug }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning edit my-1" data-id="{{ $cms->id }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger delete my-1" data-id="{{ $cms->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></button>
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
< x-delete-alert data="Do you really want to delete this CMS?" />
<!-- Edit modal -->
<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                                <input type="text" class="form-control @error('cslug') is-invalid @enderror" name="cslug" id="cslug" placeholder="Enter cms slug" value="{{ old('cslug') }}">
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
                                    <img id="preview" src="" style="width: 100%; height: 14rem; object-fit: cover; object-position: center" alt="">
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

<script>
    $(document).ready(function() {
        $('#CMS').DataTable();

        $(".delete").on("click", function() {
            let element = this;
            let id = $(this).data("id");
            $("#d").on("click", function() {
                $.ajax({
                    url: `/cms-management/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest("tr").fadeOut();
                        toastr.success(`CMS deleted successfully.`);
                    }
                });
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `/cms-management/cms/${id}`,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    $("#ctitle").val(response.title);
                    $("#cdescription").val(response.description);
                    $("#id").val(response.id);
                    $("#cslug").val(response.slug);
                    $("#preview").attr("src", `http://127.0.0.1:8000/${response.image}`);
                }
            });
        });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            let id = $("#id").val();
            let formData = new FormData(this);
            $.ajax({
                url: `/cms-management/edit/${id}`,
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                },
            });
        });

    });
</script>
@endsection