@extends('atemplate')

@section('content')

<h1 align="center">My Reservations</h1>
<a href="/reservations/rooms"  class="btn btn-primary">Show Rooms</a><br><br>
<table class="table table-bordered" id="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Room Number</th>
      <th scope="col">Paid Price In Dollars</th>
      <th scope="col">Number Of Companions</th>
    </tr>
  </thead>
  </table>
  <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('reservationdata') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'room_id', name: 'room_id' },
                        { data: 'paid_price', name: 'room_id' },
                        { data: 'no_companions', name: 'no_companions' },

                     ]
            });
         });
         </script>

@endsection
