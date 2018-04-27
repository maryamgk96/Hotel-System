@extends('admin_template')

@section('content')
               <h2>Manage Floors</h2>


             <a href="/floors/create"  class="btn btn-primary">Create New Floor</a><br><br>

             <!--
                 alert error if someone tried to delete a reserved room  
              -->
              <div class="error">
                      <ul class="error">
                       </ul>
                   </div>

                
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


         $(document).on('click','.delete',function(){
        let id = $(this).attr('target');
        let conf = confirm("Are you sure you want to Delete this record?");
        if(conf){
            $.ajax({
                url:`floors/${id}`,
                type: 'POST',
                data:{
                        '_token' : '{{csrf_token()}}',
                        '_method':'DELETE'
                    },
                success: function(res){
                    if(res){
                        $myLi=$("<li>").html("This floor can not be deleted , it has rooms associated to it ")
                        $("ul.error").append($myLi)
                        $("#error").html(res);
                        $("div.error").addClass("alert alert-danger");
                    }
                            $('#table').DataTable().ajax.reload();
                         }});
         }
        });
         </script>
 @endsection
