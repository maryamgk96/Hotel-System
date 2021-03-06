@extends('admin_template')

@section('content')

<h1 align="center">Clients Reservations</h1>

<table class="table table-bordered" id="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Room Number</th>
      <th scope="col">Client Name</th>
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
               ajax: '{{ url('allreservations') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'room_id', name: 'room_id' },
                        { data: 'client.name', name: 'client_id' },
                        { data: 'paid_price', name: 'paid_price' },
                        { data: 'no_companions', name: 'no_companions' },
                     ]
            });
         });
         </script>

@endsection