@extends('layouts.app')

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
                        <table id="banner" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Banner Caption</th>
                                    <th>Banner Description</th>
                                    <th>Banner Link</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                <tr>
                                    <td><img src="{{ url($banner->image) }}" alt="{{ $banner->banner_image }}" style="height: 5rem; object-fit: cover; object-position: center"></td>
                                    <td>{{ $banner->caption }}</td>
                                    <td>
                                        <div class="overflow-auto" style="max-height: 5rem; ">{{ $banner->description }}</div>
                                    </td>
                                    <td>{{ $banner->link }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning edit my-1" data-id="{{ $banner->id }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger delete my-1" data-id="{{ $banner->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt" data-id="$banner->id"></i></button>
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
< x-delete-alert data="Do you really want to delete this banner?" />
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
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label for="bcaption">Banner Caption</label>
                            <input type="text" class="form-control @error('bcaption') is-invalid @enderror" name="bcaption" id="bcaption" placeholder="Enter banner caption" autofocus value="">
                            @error('bcaption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fname">Banner link (optional)</label>
                            <input type="text" class="form-control @error('blink') is-invalid @enderror" name="blink" id="blink" placeholder="Enter banner link">
                            @error('blink')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Banner Description (optional)</label>
                            <textarea class="form-control" rows="11" placeholder="Enter banner description" name="bdescription" id="bdescription"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="bimage">Banner Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('bimage') is-invalid @enderror" id="bimage" name="bimage" onchange="showPreview(event)">
                                        <label class="custom-file-label" for="banner-image">Choose file</label>
                                    </div>
                                </div>
                                @error('bimage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="border rounded preview">
                                    <img id="preview" src="" style="width: 100%; height: 14rem; object-fit: cover; object-position: center" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

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
        $('#banner').DataTable();

        $(".delete").on("click", function() {
            let element = this;
            let id = $(this).data("id");
            $("#d").on("click", function() {
                $.ajax({
                    url: `/banner-management/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest("tr").fadeOut();
                        toastr.success(`Banner deleted successfully.`);
                    }
                });
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `/banner-management/banner/${id}`,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    $("#bcaption").val(response.caption);
                    $("#blink").val(response.link);
                    $("#id").val(response.id);
                    $("#bdescription").val(response.description);
                    $("#preview").attr("src", `http://127.0.0.1:8000/${response.image}`);
                }
            });
        });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            let id = $("#id").val();
            let formData = new FormData(this);
            $.ajax({
                url: `/banner-management/edit/${id}`,
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
            });
        });
    });
</script>
@endsection