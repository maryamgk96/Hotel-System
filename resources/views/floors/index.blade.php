@extends('admin_template')

@section('content')
   
<table class="table">
  <thead>
    <tr>
    
      <th scope="col">Name</th>
      <th scope="col">Number</th>
      <th scope="col">Created By</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($floors as $floor)
    <tr>
    <td>{{$floor->name}}</td>
    <td>{{$floor->id}}</td>
    <td>{{$floor->user->name}}</td>
    <td><a href="/floors/{{$floor->id}}/edit"><button class="btn btn-primary">Edit</button></a>
    <form method="post" action="/floors/{{$floor->id}}">{{method_field('delete')}}
{{csrf_field()}}<button  type="submit" class="btn btn-danger" onclick="return confirm('Are you sure that you want to delete this Floor ?')">Delete</button>
</form>
</td>
    </tr>
    @endforeach 
  </tbody>
</table>
{{ $floors->links() }} 
                   
                
              
@endsection