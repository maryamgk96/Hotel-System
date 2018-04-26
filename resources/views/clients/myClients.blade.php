@extends('admin_template')

@section('content')
               <h2>Manage Clients</h2>

                     
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     
                     <th>Name</th>
                     <th>Email</th>
                     <th>Country</th>
                     <th>Phone</th>
                     <th>Gender</th>                                              
                  </tr>
               </thead>
            </table>
            
         
       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('approvedClients') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'country', name: 'country' },
                        { data: 'mobile',name: 'mobile' },
                        { data: 'gender', name: 'gender' },                                                                                                                                                            
                        
                        
                        
                     ]
            });
         });

        
         </script>
 @endsection
