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
                                <label> Paid Price In Dollars  :</label>
                                <input type="number" class="form-control" name="paid_price" placeholder="Please Enter Paid Price">
                            </div>
                            <div class="form-group">
                                <label> Number Of Companions :</label>
                                <input  class="form-control" name="no_companions"   placeholder="Please Enter Number Of Companions">
                            </div>
                                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_z3sI6Px0jejXktcyKVO7fcO9"
                    data-amount="1999"
                    data-name="Payment"
                    data-description="Online Payment For Booking Room"
                    data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJ27fNqdS0qLdyfYtd9Xs599PtnRgxJ5o9Mg8DtE4UykIEYCZZ"
                    data-locale="auto"
                    data-currency="usd">
            </script>
              </div>
              
            </form>
          </div>
</div>

@endsection

