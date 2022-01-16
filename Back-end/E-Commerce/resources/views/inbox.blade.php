@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inbox</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Inbox</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Products</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                                @foreach ($messages as $message)

                                <tr>
                                    <td class="mailbox-name"><a href="">{{ $message->name }}</a></td>
                                    <td class="mailbox-subject">
                                        <div class="overflow-auto" style="max-height: 5rem; ">{{ $message->message }}</div>
                                    </td>
                                    <td class="mailbox-date">{{ $message->created_at }}</td>
                                    <td>
                                        <a class="btn btn-primary  my-1" href="{{ url('inbox/' . $message->id ) }}"><i class="fas fa-reply"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('script')

@if (session()->has('status'))
<script>
    toastr.success("{{ session('status') }}");
</script>
@endif

<script>
    $(document).ready(function() {
        $('#inbox').DataTable();
    });
</script>
@endsection