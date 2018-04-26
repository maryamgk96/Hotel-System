@extends('admin_template')

@section('content')
               <h2>Manage Clients</h2>


             <a href="/floors/create"  class="btn btn-primary">Create New FLoor</a><br><br>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     
                     <th>Name</th>
                     <th>Email</th>
                     <th>Country</th>
                     <th>Phone</th>
                     <th>Gender</th>
                     <th>is_approved</th>
                     <th>approved_by</th>                                                               
                     <th>Approved</th>                                                               
                     <th>actions</th>
                     
                  </tr>
               </thead>
            </table>
            
         </div>
       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('data') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'country', name: 'country' },
                        { data: 'mobile',name: 'mobile' },
                        { data: 'gender', name: 'gender' },
                        { data: 'is_approved', name: 'is_approved' }, 
                        { data: 'user.name', name: 'approved_by' }, 
                        { data: 'approve', name: 'approve', orderable: false, searchable: false },                                                                                                                                                                     
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                        
                        
                     ]
            });
         });
         </script>
 @endsection
