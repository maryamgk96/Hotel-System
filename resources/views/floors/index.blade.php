@extends('admin_template')

@section('content')
               <h2>Manage Floors</h2>


             <a href="/floors/create"  class="btn btn-primary">Create New Floor</a><br><br>

             <!--
                 alert error if someone tried to delete a reserved room  
              -->
              @if ($error)
                  <div class="alert alert-danger">
                      <ul>
                      
                       <li>{{ $error }}</li>
                       
                       </ul>
                   </div>
                @endif

                
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Number</th>
                     <th>Name</th>
                     @role('admin')
                     <th>Manager Name​</th>
                     @endrole
                     <th>Actions</th>
                  </tr>
               </thead>
            </table>
            
  
       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('getFloorsData') }}',
               @role('admin')
               columns: [
                        { data: 'number', name: 'number' },  
                        { data: 'name', name: 'name' },
                        { data: 'user.name', name: 'created_by' },
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
                @else
                columns: [
                        { data: 'number', name: 'number' },  
                        { data: 'name', name: 'name' },
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
                @endrole
            });
         });
         </script>
 @endsection
