@extends('admin_template') @section('content')
<h2>Manage Floors</h2>


<a href="/floors/create" class="btn btn-primary">Create New FLoor</a>
<br>
<br>
<table class="table table-bordered" id="table">
  <thead>
    <tr>
      <th>Number</th>
      <th>Name</th>
      <th>Manager Name​</th>
      <th>Actions</th>
    </tr>
  </thead>
</table>

<<<<<<< HEAD
             <a href="/floors/create"  class="btn btn-primary">Create New FLoor</a><br><br>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Number</th>
                     <th>Name</th>
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
               ajax: '{{ url('floordata') }}',
               columns: [
                        { data: 'number', name: 'number' },
                        { data: 'name', name: 'name' },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'actions', name: 'actions' , orderable: false, searchable: false},
                     ]
            });
         });
         </script>
 @endsection
=======
</div>
<script>
  $(function () {
    $('#table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ url('floordata ') }}',
      columns: [{
          data: 'number',
          name: 'number'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'created_by',
          name: 'created_by'
        },
        {
          data: 'actions',
          name: 'actions',
          orderable: false,
          searchable: false
        },
      ]
    });
  });
</script>
@endsection
>>>>>>> 995eb3dc7cd70f954667991cd833aaf2b592aaa9
