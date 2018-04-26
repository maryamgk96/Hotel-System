<form action="/clients/{{$id}}" method="post" >
    @csrf
    @method('DELETE')
    @hasanyrole('manager|admin')
    <a href="/clients/{{$id}}/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
    <button class="btn btn-danger" onclick="return confirm('Are You Sure You Would Like to Delete This Post?');">Delete</button>         
    @endhasanyrole
    @if($approvedFlag == 0)
    <a href="/clients/{{$id}}/approve" class="btn btn-xm btn-primary" ><i class="fa fa-check"></i> Approve</a>          
    @endif
</form>