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
                <h2 class="text-center">Create New Room</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="form-horizontal" method="post" action="/rooms">
                {{csrf_field()}}

                <!-- text input -->
                <div class="box-body">
                    <br>
                    <div class="input-group">
                        <label>Number</label>
                        <input type="text" name="number" class="form-control" placeholder="Enter Room Number">
                    </div>
                    <br>
                    <div class="input-group">
                        <label>Capacity</label>
                        <input type="number" name="capacity" class="form-control" placeholder="Enter room capacity">
                    </div>
                    <br>
                    <div class="input-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Enter room price in dollars">
                    </div>
                    <br>
                    <!-- select -->
                    <div class="input-group">
                        <label>Floor</label>
                        <select class="form-control" name="floor_id">
                            @foreach ($floors as $floor)
                            <option value="{{$floor->id}}">{{$floor->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Create"/>
                </div>

        </div>
    </div>
    <div class='col-lg-3'></div>
</div>

</form>
</div>


@endsection