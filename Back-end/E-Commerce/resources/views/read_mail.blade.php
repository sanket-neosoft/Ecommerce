@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/inbox') }}">Inbox</a></li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Read Message</h3>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{url('/send-reply')}}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $message->email }}">
                        <input type="hidden" name="id" value="{{ $message->id }}">
                        <div class="card-body">
                            <div class="mailbox-read-info">
                                <h5>{{ $message->name }}</h5>
                                <h6>From: {{ $message->email }}
                                    <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span>
                                </h6>
                            </div>
                            <!-- /.mailbox-read-info -->
                            <div class="mailbox-read-message">
                                <p>Hello Admin,</p>

                                <p>{{ $message->message }}</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                            <div class="form-group">
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject" placeholder="Subject" autofocus value="{{ old('subject') }}">
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="8" name="message"></textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
</div>

@endsection
@section('script')

<script>
</script>
@endsection