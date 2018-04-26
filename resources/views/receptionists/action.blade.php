    <a href="/receptionists/{{$id}}/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
    <button  target="{{$id}}"  class='delete btn btn-xm btn-danger' > Delete </button>
    @if($banFlag == 1)
        <a href="/unban/{{$id}}" class="btn btn-xm btn-primary" >Unban</a>
    @else
        <a href="/ban/{{$id}}" class="btn btn-xm btn-primary" >Ban</a>
    @endif          


