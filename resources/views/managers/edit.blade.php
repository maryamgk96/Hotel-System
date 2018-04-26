@extends('admin_template')

@section('content')
<h1>Edit Manager</h1><br><br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<img src="{{ url($manager->avatar) }}" class="img-circle" width="150" height="130">

<form role="form" method="POST" action="/managers/{{ $manager->id }}"  enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="box-body">
            <label>Email</label>        
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control" value="{{ $manager->email }}" name="email">
          </div>
          <br>
          <label>Username</label>          
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" value="{{ $manager->name }}" name="name">
          </div>
          <br>
          <label>National ID</label>          
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
            <input type="text" class="form-control" value="{{ $manager->national_id }}" name="national_id">
          </div>
          <br>
        <div class="form-group">
                <label>Avatar</label>
          <input type="file" name="avatar">
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
     
</form>
 @endsection