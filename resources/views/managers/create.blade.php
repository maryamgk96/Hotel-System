@extends('admin_template')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<br><br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">

        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="text-center">Create New Manager</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form role="form" method="POST" class="form-horizontal" action="/managers"  enctype="multipart/form-data">
                @csrf

                <div class="box-body">
                    <label>Email</label>        
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <br>
                    <label>Username</label>          
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <br>
                    <label>National ID</label>          
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                        <input type="text" class="form-control" placeholder="National ID" name="national_id">
                    </div>
                    <br>
                    <label>Password</label>          
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                    </div>
                    <br>
                    <div class="input-group">
                        <label>Avatar</label>
                        <input type="file" name="avatar">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
    </div>
    <div class='col-lg-3'></div>
</div>
</form>
@endsection