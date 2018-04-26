@extends('admin_template')
@section('content')

<h1>Edit Floor</h1><br><br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="/floors/{{$floor->id}}">
{{method_field('put')}}
{{csrf_field()}}

  <div class="form-group">
    <label >Name</label>
    <input type="text" class="form-control" name="name" value="{{$floor->name}}">
  </div>
  
  

  <input type="submit" class="btn btn-info" value="Update"/>
  
</form>
@endsection