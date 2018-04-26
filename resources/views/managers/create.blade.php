@extends('admin_template')

@section('content')
<h1>Create new Manager</h1><br><br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form role="form" method="POST" action="/managers"  enctype="multipart/form-data">
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
          <label>National ID</label>          
          <div class="input-group">
                <span class="input-group-addon"><i class="	fa fa-address-card-o"></i></span>
            <input type="text" class="form-control" placeholder="phone" name="phone">
          </div>
          <br>
          <label>Password</label>          
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <br>
        <div class="form-group">
                <label>Avatar</label>
          <input type="file" id="exampleInputFile">
        </div>

          <div class="row">
            
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
            <label>Gender</label>                
              <div class="input-group">
                
                    <input type="radio" name="gender" value="0"> Male<br>
                    <input type="radio" name="gender" value="1"> Female<br>              
                    
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
          </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
     
</form>
 @endsection