@extends('admin_template')

@section('content')
               <h2>Manage Rooms</h2>


             <a href="/rooms/create"  class="btn btn-primary">Create New Room</a><br><br>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Number</th>
                     <th>Capacity</th>
                     <th>Price In Dollars</th>
                     <th>Floor Name</th>
                     <th>Manager Name​</th>
                     <th>Actions</th>
                  </tr>
               </thead>
            </table>
            
         </div>
       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('roomdata') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'capacity', name: 'capacity' },
                        { data: 'price', name: 'price'},
                        { data: 'floor_id', name: 'floor_id' },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
            });
         });
         </script>
 @endsection
