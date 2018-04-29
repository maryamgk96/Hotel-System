
@extends('admin_template')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<br><br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">

        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="text-center">Update Room</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <form role="form" method="post" class="form-horizontal" action="/rooms/{{$room->id}}">
                    {{method_field('put')}} {{csrf_field()}}
                    <div class="box-body">
                        <br>
                        <!-- text input -->
                        <div class="input-group">
                            <label>Number</label>
                            <input type="number" name="number" value="{{$room->number}}" class="form-control">
                        </div>
                        <br>
                        <div class="input-group">
                            <label>Capacity</label>
                            <input type="number" name="capacity" class="form-control" value="{{$room->capacity}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="{{$room->price}}" ></div>
                        <br>
                        <!-- select -->
                        <div class="input-group">
                            <label>Floor</label>
                            <select class="form-control" name="floor_id">
                                @foreach ($floors as $floor)
                                <option @if($floor->id == $room->floor->id) selected @endif value="{{$floor->id}}">{{$floor->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Update" />
                        </div>
                    </div>
            </div>
            <div class='col-lg-3'></div>
        </div>
        </form>
    </div>
    @endsection