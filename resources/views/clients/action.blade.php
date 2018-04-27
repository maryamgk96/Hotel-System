
    @hasanyrole('manager|admin')
    <a href="/clients/{{$id}}/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
<a href="#" class="btn btn-danger delete" id="{{$id}}"><i class="fa fa-remove"></i> Delete</a>

    @endhasanyrole
    @if($approvedFlag == 0)
    <a href="/clients/{{$id}}/approve" class="btn btn-xm btn-primary" ><i class="fa fa-check"></i> Approve</a>          
    @endif
{{-- </form> --}}