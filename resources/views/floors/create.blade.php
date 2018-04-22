@extends('admin_template')

@section('content')
<h1>Create new Floor</h1><br><br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form role="form" method="post" action="/floors">
    {{csrf_field()}}

    <div class="box-body">
        <div class="form-group">
            <label >Floor Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter floor name">
        </div>
    </div>
     <div class="box-footer">
         <input type="submit" class="btn btn-primary" value="Create"/>
    </div>
     
</form>
 @endsection