@extends('admin_template')

@section('content')
               <h2>Manage Managers</h2>


             <a href="/managers/create"  class="btn btn-primary">Create New Manager</a><br><br>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Created At</th>
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
               ajax: '{{ url('getManagersData') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'created_at', name: 'created_at'},
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
            });
         });
         </script>
 @endsection
