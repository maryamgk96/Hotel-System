@extends('admin_template')

@section('content')
<section class="content"  >
<div class="text-center" >

      <div class="row" >
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary" >
            <div class="box-header with-border" align="center">
              <h3 class="box-title">Create New Reservation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"method="post" action="/reservations/{{$room->id}}">
            {{csrf_field()}}
           
                            <div class="form-group">
                                <label> Paid Price :</label>
                                <input type="text" class="form-control" name="paid_price" placeholder="Please Enter Paid Price">
                            </div>
                            <div class="form-group">
                                <label> Number Of Companions :</label>
                                <input type="text" class="form-control" name="no_companions"  placeholder="Please Enter Number Of Companions">
                            </div>
                                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
</div>

@endsection

