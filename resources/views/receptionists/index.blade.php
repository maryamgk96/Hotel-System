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
  $(document).on('click','.delete',function(){
  let id = $(this).attr('target');
  let conf = confirm("Are You Sure You Want To Delete That Record?");
  if(conf){
  $.ajax({
      url:`users/${id}`,
      type: 'POST',
      data:{
          '_token' : '{{csrf_token()}}',
          '_method':'DELETE'
      },success: function(){
            $('#table').DataTable().ajax.reload();
    }});
  }
});
         </script>
 @endsection
