@extends('atemplate')

@section('content')
               <h2>Available Rooms</h2>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Number</th>
                     <th>Capacity</th>
                     <th>Price In Dollars</th>
                     <th>Action</th>
                  </tr>
               </thead>
            </table>
            
         </div>
       <script>
         $(function() { 
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('reservations/roomsdata') }}',
               columns: [
                        { data: 'number', name: 'id' },
                        { data: 'capacity', name: 'capacity' },
                        { data: 'price', name: 'price'},
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
            });
         });
         </script>
 @endsection
