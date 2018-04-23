@extends('admin_template') @section('content')
<h1>Create new Room</h1>
<br>
<br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="box-body">
    <form role="form" method="post" action="/rooms">
        {{csrf_field()}}

        <!-- text input -->

        <div class="form-group">
            <label>Number</label>
            <input type="text" name="number" class="form-control" placeholder="Enter Room Number">
        </div>

        <div class="form-group">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" placeholder="Enter room capacity">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" class="form-control" placeholder="Enter room price">
        </div>

        <!-- select -->
        <div class="form-group">
            <label>Floor</label>
            <select class="form-control" name="floor_id">
                @foreach ($floors as $floor)
                <option value="{{$floor->id}}">{{$floor->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Create" />
    </form>
</div>


@endsection