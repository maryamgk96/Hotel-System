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
<div class="row">
    <div class="col-md-3">
        <img src="{{ url($receptionist->avatar) }}" class="img-circle" width="300" height="300">
    </div>
    <div class="col-md-6 ">

        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="text-center">Update Manager</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->


            <form role="form" method="POST" class="form-horizontal" action="/receptionists/{{ $receptionist->id }}"  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <label>Email</label>        
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" value="{{ $receptionist->email }}" name="email">
                    </div>
                    <br>
                    <label>Username</label>          
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" value="{{ $receptionist->name }}" name="name">
                    </div>
                    <br>
                    <label>National ID</label>          
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                        <input type="text" class="form-control" value="{{ $receptionist->national_id }}" name="national_id">
                    </div>
                    <br>
                    <div class="input-group">
                        <label>Avatar</label>
                        <input type="file" name="avatar">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
        </div>
    </div>
    <div class='col-lg-3'></div>
</div>

</form>
@endsection