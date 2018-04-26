<form action="/managers/{{$id}}" method="post" >
    @csrf
    @method('DELETE')
    <a href="/managers/{{$id}}/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
    <button class="btn btn-danger" onclick="return confirm('Are You Sure You Would Like to Delete This Post?');">Delete</button>         
</form>

