@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/store_user" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="" name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" placeholder="Enter email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid  @enderror" name="password" id="exampleInputPassword1" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection