@extends('admin_template')

@section('content')
               <h2>Manage Rooms</h2>

      
             <a href="/rooms/create"  class="btn btn-primary">Create New Room</a><br><br>
              
             
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
                     <th>Capacity</th>
                     <th>Price In Dollars</th>
                     <th>Floor Name</th>
                     @role('admin')
                     <th>Manager Name​</th>
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
               ajax: '{{ url('getRoomsData') }}',
               @role('admin')
               columns: [
                        { data: 'number', name: 'number' },
                        { data: 'capacity', name: 'capacity' },
                        { data: 'price', name: 'price' },
                        { data: 'floor.name', name: 'floor_id' },
                        { data: 'user.name', name: 'created_by' },
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
                @else
                columns: [
                        { data: 'number', name: 'number' },
                        { data: 'capacity', name: 'capacity' },
                        { data: 'price', name: 'price' },
                        { data: 'floor.name', name: 'floor_id' },
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
                @endrole 
            });
         });

         $(document).on('click','.delete',function(){
        let id = $(this).attr('target');
        let conf = confirm("Are you sure you want to delete this record?");
        if(conf){
            $.ajax({
                url:`rooms/${id}`,
                type: 'POST',
                data:{
                        '_token' : '{{csrf_token()}}',
                        '_method':'DELETE'
                    },
                success: function(res){
                    if(res){
                        $myLi=$("<li>").html("This room can not be deleted , it is a reserved room ")
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
