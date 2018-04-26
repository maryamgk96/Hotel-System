<form action="/receptionists/{{$id}}" method="post" >
    @csrf
    @method('DELETE')
    <a href="/receptionists/{{$id}}/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
    <button class="btn btn-danger" onclick="return confirm('Are You Sure You Would Like to Delete This Post?');">Delete</button>
    @if($banFlag == 1)
        <a href="/unban/{{$id}}" class="btn btn-xm btn-primary" >Unban</a>
    @else
        <a href="/ban/{{$id}}" class="btn btn-xm btn-primary" >Ban</a>
    @endif          
</form>

