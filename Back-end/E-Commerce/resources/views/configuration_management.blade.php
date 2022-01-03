@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Configuration Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Configuration Management</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Notification Configuration</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">{{ $user->firstname . " " . $user->lastname }}</h3>

                                        <p class="text-muted text-center">{{ $user->role->role_name }}</p>

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <p class="mb-1"><b>Email</b></p>
                                                <a>{{ $user->email }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="mb-1"><b>Notification Email</b></p>
                                                <a>{{ $user->config->notification_email }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Email configuration</h3>
                                    </div>
                                    <form action="{{ url('/configuration-management/edit') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <p class="lead">You can change your notification email but your login email id will be same. You will get all notification on notification email.</p>
                                            <div class="form-group col-md">
                                                <label for="nemail">Notification Email</label>
                                                <input type="text" class="form-control @error('nemail') is-invalid @enderror" name="nemail" id="nemail" placeholder="Enter notification email"  value="{{ $user->config->notification_email }}">
                                                @error('bname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Change</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')

@if (session('status') === "success")

<!-- toastr success -->
<script>
    toastr.success("Notification email changed successfully");
</script>

@elseif (session('status') === "failed")

<!-- toastr danger  -->
<script>
    toastr.error("Failed to add product.");
</script>

@else 
<script>
    console.log("{{ session('status') }}");
</script>
@endif
@endsection