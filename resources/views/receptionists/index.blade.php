@extends('admin_template')

@section('content')
               <h2>Manage Receptionists</h2>


             <a href="/receptionists/create"  class="btn btn-primary">Create New Receptionist</a><br><br>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Created At</th>
                     @role('admin')
                     <th>Created By</th>
                     @endrole
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
               ajax: '{{ url('getReceptionistsData') }}',
               @role('admin')
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'created_at', name: 'created_at'},
                        { data: 'user.name', name: 'created_by'},
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
                @else
                columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'created_at', name: 'created_at'},
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
                @endrole 
            });
         });
        
         </script>
 @endsection
