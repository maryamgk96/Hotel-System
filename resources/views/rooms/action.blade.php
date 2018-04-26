<form action="/rooms/{{$id}}" method="post" >
    @csrf
    @method('DELETE')
    <a href="/rooms/{{$id}}/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
    <button class="btn btn-danger" onclick="return confirm('Are You Sure You Would Like to Delete This Room?');">Delete</button>       
</form>

