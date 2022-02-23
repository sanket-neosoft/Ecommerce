@extends("layouts.app")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User Management</li>
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
                        <h3 class="card-title">All Users Info</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="user" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Role</th>
                                    <th>Active</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->firstname . " " . $user->lastname}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->role_name }}</td>
                                    <td>{{ $user->active }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning edit my-1" data-id="{{ $user->id }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger delete my-1" data-id="{{ $user->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></button>
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
<!-- Delete modal -->
< x-delete-alert data="Do you really want to delete this User?" />
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
                    <input type="hidden" id="id">
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" placeholder="Enter first name" autofocus value="">
                            <span class="text-danger" role="alert">
                                <small><strong id="fname_error"></strong></small>
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" id="lname" placeholder="Enter last name" value="">
                            <span class="text-danger" role="alert">
                                <small><strong id="lname_error"></strong></small>
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" disabled name="email" id="email" placeholder="Enter email" value="">
                            <span class="text-danger" role="alert">
                                <small><strong id="email_error"></strong></small>
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Select Role</label>
                            <select name="role" id='role' class="form-control @error('email') is-invalid @enderror">
                                @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" role="alert">
                                <small><strong id="role_error"></strong></small>
                            </span>
                        </div>
                        <div class="form-group col-md-6 my-3">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3" value="active" name="active">
                                <label class="custom-control-label" for="customSwitch3">Active</label>
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
@section("script")

<script>
    $(document).ready(function() {
        $("#user").DataTable();

        $(".delete").on("click", function() {
            let element = this;
            let id = $(this).data("id");
            $("#d").on("click", function() {
                $.ajax({
                    url: `/user-management/delete/${id}`,
                    method: "delete",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $(element).closest("tr").fadeOut();
                        toastr.success(`User deleted successfully.`);
                    }
                });
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `/user-management/user/${id}`,
                method: 'get',
                success: function(response) {
                    console.log(response);
                    $("#fname").val(response.firstname);
                    $("#lname").val(response.lastname);
                    $("#email").val(response.email);
                    $("#id").val(response.id);
                    $(`select option[value=${response.role_id}]`).attr("selected", true);
                    if (response.active === 1) {
                        $("#customSwitch3").prop("checked", true);
                    }
                }
            });
        });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            let id = $("#id").val();
            console.log($("#role").val());
            $.ajax({
                url: `/user-management/edit/${id}`,
                type: "post",
                data: {
                    _token: `{{ csrf_token() }}`,
                    fname: $("input[name='fname']").val(),
                    lname: $("input[name='lname']").val(),
                    email: $("input[name='email']").val(),
                    role: $("#role").val(),
                    active: $("input[name='active']").val(),
                },
                success: function(response) {
                    if (response === "success") {
                        location.reload();
                    } else {
                        if (response.fname) {
                            $("#fname_error").text(response.fname[0]);
                        }
                        if (response.lname) {
                            $("#lname_error").text(response.lname[0]);
                        }
                    }
                },
            });
        });
    });
</script>
@endsection