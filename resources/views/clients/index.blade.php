@extends('admin_template')

@section('content')
               <h2>Manage Clients</h2>

               @hasanyrole('manager|admin')
             <a href="/clients/create"  class="btn btn-primary">Create New Client</a><br><br>
             @endhasanyrole

             @hasrole('receptionist')
             <a href="clients/myclients"  class="btn btn-primary">My Clients</a><br><br>
              @endhasrole             
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     
                     <th>Name</th>
                     <th>Email</th>
                     <th>Country</th>
                     <th>Phone</th>
                     <th>Gender</th>                                              
                     <th>actions</th>
                     
                  </tr>
               </thead>
            </table>
            
         
       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('clientsdata') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'country', name: 'country' },
                        { data: 'mobile',name: 'mobile' },
                        { data: 'gender', name: 'gender' },                                                                                                                                                            
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                        
                        
                     ]
            });
         });

         
    
         
         $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        if(confirm("Are you sure you want to Delete this client?"))
        {
            $.ajax({
                url:"{{route('client.delete')}}",
                type: 'POST',
                data: {'_token':'{{csrf_token()}}','_method':'DELETE',id:id},
                success:function()
                {   
                    
                    $('#table').DataTable().ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    }); 
        
         </script>
 @endsection
